import React, { useEffect, useMemo, useRef, useState } from 'react';
import { httpErrorToHuman } from '@/api/http';
import { motion } from 'framer-motion';
import Spinner from '@/components/elements/Spinner';
import FileObjectRow from '@/components/server/files/FileObjectRow';
import FileManagerBreadcrumbs from '@/components/server/files/FileManagerBreadcrumbs';
import loadDirectory, { FileObject } from '@/api/server/files/loadDirectory';
import NewDirectoryButton from '@/components/server/files/NewDirectoryButton';
import UrlDownloadButton from '@/components/server/files/UrlDownloadButton';
import { NavLink, useLocation } from 'react-router-dom';
import Can from '@/components/elements/Can';
import { ServerError } from '@/components/elements/ScreenBlock';
import tw from 'twin.macro';
import { Button } from '@/components/elements/button/index';
import { ServerContext } from '@/state/server';
import useFileManagerSwr from '@/plugins/useFileManagerSwr';
import FileManagerStatus from '@/components/server/files/FileManagerStatus';
import MassActionsBar from '@/components/server/files/MassActionsBar';
import UploadButton from '@/components/server/files/UploadButton';
import ServerContentBlock from '@/components/elements/ServerContentBlock';
import { useStoreActions } from '@/state/hooks';
import ErrorBoundary from '@/components/elements/ErrorBoundary';
import { FileActionCheckbox } from '@/components/server/files/SelectFileCheckbox';
import { hashToPath, encodePathSegments } from '@/helpers';
import style from './style.module.css';
import { SearchIcon, XIcon, FolderIcon, FolderOpenIcon, DocumentIcon } from '@heroicons/react/solid';
import Card from '@/reviactyl/ui/Card';
import { useTranslation } from 'react-i18next';
import ImageViewerModal from '@/components/server/files/ImageViewerModal';
import getFileDownloadUrl from '@/api/server/files/getFileDownloadUrl';
import { join } from 'pathe';
import { bytesToString } from '@/lib/formatters';

const sortFiles = (files: FileObject[]): FileObject[] => {
    const sortedFiles: FileObject[] = files
        .sort((a, b) => a.name.localeCompare(b.name))
        .sort((a, b) => (a.isFile === b.isFile ? 0 : a.isFile ? 1 : -1));
    return sortedFiles.filter((file, index) => index === 0 || file.name !== sortedFiles[index - 1]?.name);
};

type SearchResult = FileObject & { fullPath: string };

const RecursiveFileRow = ({ file, serverId }: { file: SearchResult; serverId: string }) => {
    const to = file.isFile
        ? `/server/${serverId}/files/edit#${encodePathSegments(file.fullPath)}`
        : `/server/${serverId}/files#${encodePathSegments(file.fullPath)}`;
    const Icon = file.isFile ? DocumentIcon : FolderIcon;
    return (
        <div className='flex items-center py-2 px-2 border-b border-neutral-700 last:border-0 hover:bg-neutral-700 rounded'>
            <Icon className='w-4 h-4 mr-3 flex-none text-neutral-400' aria-hidden='true' />
            <NavLink to={to} className='flex-1 text-sm text-neutral-200 truncate hover:text-primary-400 min-w-0'>
                {file.fullPath}
            </NavLink>
            {file.isFile && <span className='text-xs text-neutral-500 ml-3 flex-none'>{bytesToString(file.size)}</span>}
        </div>
    );
};

export default () => {
    const { t } = useTranslation('server/files');
    const id = ServerContext.useStoreState((state) => state.server.data!.id);
    const uuid = ServerContext.useStoreState((state) => state.server.data!.uuid);
    const { hash } = useLocation();
    const { data: files, error, mutate } = useFileManagerSwr();
    const directory = ServerContext.useStoreState((state) => state.files.directory);
    const clearFlashes = useStoreActions((actions) => actions.flashes.clearFlashes);
    const setDirectory = ServerContext.useStoreActions((actions) => actions.files.setDirectory);

    const setSelectedFiles = ServerContext.useStoreActions((actions) => actions.files.setSelectedFiles);
    const selectedFilesLength = ServerContext.useStoreState((state) => state.files.selectedFiles.length);

    // Image viewer state
    const [imageViewerVisible, setImageViewerVisible] = useState(false);
    const [selectedImage, setSelectedImage] = useState<{ url: string; name: string } | null>(null);

    const [inputValue, setInputValue] = useState('');
    const [query, setQuery] = useState('');
    const [recursiveResults, setRecursiveResults] = useState<SearchResult[]>([]);
    const [isSearching, setIsSearching] = useState(false);
    const searchGenRef = useRef(0);

    useEffect(() => {
        clearFlashes('files');
        setSelectedFiles([]);
        setDirectory(hashToPath(hash));
        setInputValue('');
    }, [hash]);

    useEffect(() => {
        mutate();
    }, [directory]);

    useEffect(() => {
        const timer = setTimeout(() => setQuery(inputValue), 300);
        return () => clearTimeout(timer);
    }, [inputValue]);

    useEffect(() => {
        if (!query) {
            setRecursiveResults([]);
            setIsSearching(false);
            return;
        }

        const gen = ++searchGenRef.current;
        setIsSearching(true);
        setRecursiveResults([]);

        (async () => {
            const matches: SearchResult[] = [];
            const queue: string[] = ['/'];
            const seen = new Set<string>(['/']);
            const MAX_FILES = 250;
            const CONCURRENCY = 3;

            while (queue.length > 0 && gen === searchGenRef.current && matches.length < MAX_FILES) {
                const batch = queue.splice(0, CONCURRENCY);
                const settled = await Promise.allSettled(
                    batch.map((dir) => loadDirectory(uuid, dir).then((dirFiles) => ({ dir, dirFiles })))
                );

                if (gen !== searchGenRef.current) break;

                for (const result of settled) {
                    if (result.status !== 'fulfilled') continue;
                    const { dir, dirFiles } = result.value;
                    for (const f of dirFiles ?? []) {
                        const fp = `${dir === '/' ? '' : dir}/${f.name}`.replace(/\/+/g, '/');
                        if (!f.isFile && !seen.has(fp)) {
                            seen.add(fp);
                            queue.push(fp);
                        }
                        if (f.name.toLowerCase().includes(query.toLowerCase())) {
                            matches.push({ ...f, fullPath: fp, key: fp });
                        }
                    }
                }

                if (gen === searchGenRef.current) {
                    setRecursiveResults([...matches]);
                }
            }

            if (gen === searchGenRef.current) setIsSearching(false);
        })().catch(() => {
            if (gen === searchGenRef.current) setIsSearching(false);
        });
    }, [query]); // eslint-disable-line react-hooks/exhaustive-deps

    const filteredFiles = useMemo(() => {
        if (!files) return [];
        return files;
    }, [files]);

    const onSelectAllClick = (e: React.ChangeEvent<HTMLInputElement>) => {
        setSelectedFiles(e.currentTarget.checked ? (query ? [] : filteredFiles.map((file) => file.name)) : []);
    };

    const handleImageClick = (file: FileObject) => {
        const filePath = join(directory, file.name);
        getFileDownloadUrl(uuid, filePath)
            .then((url) => {
                setSelectedImage({ url, name: file.name });
                setImageViewerVisible(true);
            })
            .catch((error) => {
                console.error('Failed to get image URL:', error);
            });
    };

    const handleImageViewerClose = () => {
        setImageViewerVisible(false);
        setSelectedImage(null);
    };

    if (error) {
        return <ServerError message={httpErrorToHuman(error)} onRetry={() => mutate()} />;
    }

    return (
        <ServerContentBlock title={t('title')} showFlashKey={'files'}>
            <ErrorBoundary>
                <Card className={'flex flex-col mb-1 mt-2 !rounded-b-none !px-2 !py-3'}>
                    <div className='flex flex-wrap md:flex-nowrap items-center gap-2'>
                        <FileActionCheckbox
                            type={'checkbox'}
                            css={tw`mx-2`}
                            checked={!query && selectedFilesLength > 0 && selectedFilesLength === filteredFiles.length}
                            onChange={onSelectAllClick}
                        />
                        <div role='search' className='relative flex items-center flex-1 min-w-0'>
                            <SearchIcon className='absolute left-2 h-4 w-4 text-neutral-400 pointer-events-none' />
                            <input
                                type='text'
                                placeholder={t('search.placeholder')}
                                aria-label={t('search.placeholder')}
                                value={inputValue}
                                onChange={(e) => setInputValue(e.target.value)}
                                onKeyDown={(e) => {
                                    if (e.key === 'Escape') setInputValue('');
                                }}
                                className='w-full bg-neutral-700 rounded pl-8 pr-8 py-1.5 text-sm text-neutral-100 placeholder-neutral-400 border border-neutral-600 focus:outline-none focus:border-primary-400'
                            />
                            {inputValue && (
                                <button
                                    type='button'
                                    aria-label={t('search.clear')}
                                    onClick={() => setInputValue('')}
                                    className='absolute right-2 text-neutral-400 hover:text-neutral-200'
                                >
                                    <XIcon className='h-4 w-4' />
                                </button>
                            )}
                        </div>
                        <Can action={'file.create'}>
                            <div className={style.manager_actions}>
                                <FileManagerStatus />
                                <UrlDownloadButton />
                                <NewDirectoryButton />
                                <UploadButton />
                                <NavLink to={`/server/${id}/files/new${window.location.hash}`}>
                                    <Button>{t('new-file')}</Button>
                                </NavLink>
                            </div>
                        </Can>
                    </div>
                    <div className='flex items-center mt-2'>
                        <FileManagerBreadcrumbs />
                    </div>
                </Card>
            </ErrorBoundary>
            {!files ? (
                <Spinner size={'large'} centered />
            ) : (
                <Card className='!rounded-t-none !p-3'>
                    {query ? (
                        isSearching && recursiveResults.length === 0 ? (
                            <Spinner size={'base'} centered />
                        ) : recursiveResults.length === 0 ? (
                            <div className={'flex flex-col items-center justify-center py-10 text-neutral-500'}>
                                <SearchIcon className={'w-10 h-10 mb-2 opacity-40'} />
                                <p className={'text-sm'}>{t('no-results')}</p>
                            </div>
                        ) : (
                            <motion.div
                                initial={{ opacity: 0 }}
                                animate={{ opacity: 1 }}
                                transition={{ duration: 0.15, ease: 'easeIn' }}
                            >
                                {isSearching && <p css={tw`text-xs text-neutral-500 text-center mb-2`}>Searching...</p>}
                                {recursiveResults.map((file) => (
                                    <RecursiveFileRow key={file.fullPath} file={file} serverId={id} />
                                ))}
                            </motion.div>
                        )
                    ) : !filteredFiles.length ? (
                        <div className={'flex flex-col items-center justify-center py-10 text-neutral-500'}>
                            <FolderOpenIcon className={'w-12 h-12 mb-2 opacity-40'} />
                            <p className={'text-sm'}>{t('empty')}</p>
                        </div>
                    ) : (
                        <motion.div
                            initial={{ opacity: 0 }}
                            animate={{ opacity: 1 }}
                            transition={{ duration: 0.15, ease: 'easeIn' }}
                        >
                            {files.length > 250 && (
                                <div css={tw`rounded bg-yellow-400 mb-px p-3`}>
                                    <p css={tw`text-yellow-900 text-sm text-center`}>{t('too-large')}</p>
                                </div>
                            )}
                            {sortFiles(filteredFiles.slice(0, 250)).map((file) => (
                                <FileObjectRow key={file.key} file={file} onImageClick={handleImageClick} />
                            ))}
                            <MassActionsBar />
                        </motion.div>
                    )}
                </Card>
            )}
            {selectedImage && (
                <ImageViewerModal
                    visible={imageViewerVisible}
                    onDismissed={handleImageViewerClose}
                    imageUrl={selectedImage.url}
                    imageName={selectedImage.name}
                    appear
                />
            )}
        </ServerContentBlock>
    );
};
