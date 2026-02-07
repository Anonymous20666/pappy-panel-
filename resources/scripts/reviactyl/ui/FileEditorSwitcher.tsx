import React, { useState, useEffect } from 'react';
import { useTranslation } from 'react-i18next';
import { ApplicationStore } from '@/state';
import { useStoreActions, useStoreState } from 'easy-peasy';
import updateEditor from '@/api/account/updateAccountEditor';
import Select from '@/components/elements/Select';

interface FileEditorSwitcherProps {
    display: string;
}

const FileEditorSwitcher: React.FC = () => {
    const { t } = useTranslation('dashboard/account');
    const user = useStoreState((state: ApplicationStore) => state.user.data);
    const setUserData = useStoreActions((actions: any) => actions.user.setUserData);
    const [editors, setEditors] = useState<Record<string, FileEditorSwitcherProps>>({});
    const [currentEditor, setCurrentEditor] = useState(user?.fileEditor || 'cm');

    useEffect(() => {
        fetch('/file-editors/list.json')
            .then((res) => res.json())
            .then((data) => setEditors(data))
            .catch(() => setEditors({ cm: { display: 'CodeMirror (Default Editor)' }, mo: { display: 'Monaco (Like VS Code)' } }));
    }, []);

    const handleChange = async (e: React.ChangeEvent<HTMLSelectElement>) => {
        const newEditor = e.target.value;
        setCurrentEditor(newEditor);    

        if (user) {
            try {
                await updateEditor({ fileEditor: newEditor });
                setUserData({ ...user, fileEditor: newEditor });
            } catch (error) {
                console.error('Failed to update editor:', error);
            }
        }
    }

    return (
        <div className='flex justify-between items-center mb-2'>
            <p className='flex-1'>{t('overview.editor')}</p>
            <Select className='!pr-15 !w-auto' value={currentEditor} onChange={handleChange}>
                {Object.entries(editors).map(([key, name]) => (
                    <option key={key} value={key}>
                        {name.display}
                    </option>
                ))}
            </Select>
        </div>
    );
};

export default FileEditorSwitcher;