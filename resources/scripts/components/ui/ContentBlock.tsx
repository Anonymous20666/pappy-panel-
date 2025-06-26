import PageContentBlock, { PageContentBlockProps } from '@/components/elements/PageContentBlock';
import React from 'react';
import { ApplicationStore } from '@/state';
import { useStoreState } from 'easy-peasy';
import Title from '@/components/ui/Title';

interface Props extends PageContentBlockProps {
    title: string;
}

const ContentBlock: React.FC<Props> = ({ title, children, ...props }) => {
    const name = useStoreState((state: ApplicationStore) => state.settings.data!.name);

    return (
        <PageContentBlock title={`${title} | ${name}`} {...props}>
            <Title className="text-4xl">{title}</Title>
            {children}
        </PageContentBlock>
    );
};

export default ContentBlock;
