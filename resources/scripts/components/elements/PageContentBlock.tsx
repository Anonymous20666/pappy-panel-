import React, { useEffect, useRef } from 'react';
import ContentContainer from '@/components/elements/ContentContainer';
import { CSSTransition } from 'react-transition-group';
import tw from 'twin.macro';
import FlashMessageRender from '@/components/FlashMessageRender';
import Footer from '@/reviactyl/ui/Footer';

export interface PageContentBlockProps {
    title?: string;
    className?: string;
    showFlashKey?: string;
    children?: React.ReactNode;
}

const PageContentBlock = ({ title, showFlashKey, className, children }: PageContentBlockProps) => {
    useEffect(() => {
        if (title) {
            document.title = title;
        }
    }, [title]);

    const nodeRef = useRef(null);

    return (
        <CSSTransition timeout={150} classNames={'fade'} appear in nodeRef={nodeRef}>
            <div ref={nodeRef}>
                <ContentContainer className={className}>
                    {showFlashKey && <FlashMessageRender byKey={showFlashKey} css={tw`mb-4`} />}
                    {children}
                </ContentContainer>
                <ContentContainer css={tw`mb-4`}>
                    <Footer />
                </ContentContainer>
            </div>
        </CSSTransition>
    );
};

export default PageContentBlock;
