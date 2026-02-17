import React, { useRef } from 'react';
import tw from 'twin.macro';
import styled from 'styled-components';
import CSSTransition, { CSSTransitionProps } from 'react-transition-group/CSSTransition';

interface Props extends Omit<CSSTransitionProps, 'timeout' | 'classNames'> {
    timeout: number;
}

const Container = styled.div<{ timeout: number }>`
    .fade-enter,
    .fade-exit,
    .fade-appear {
        will-change: opacity;
    }

    .fade-enter,
    .fade-appear {
        ${tw`opacity-0`};

        &.fade-enter-active,
        &.fade-appear-active {
            ${tw`opacity-100 transition-opacity ease-in`};
            transition-duration: ${(props) => props.timeout}ms;
        }
    }

    .fade-exit {
        ${tw`opacity-100`};

        &.fade-exit-active {
            ${tw`opacity-0 transition-opacity ease-in`};
            transition-duration: ${(props) => props.timeout}ms;
        }
    }
`;

const Fade = React.forwardRef<HTMLDivElement, Props>(({ timeout, children, ...props }, ref) => {
    const nodeRef = useRef<HTMLDivElement>(null);
    const combinedRef = (node: HTMLDivElement) => {
        if (typeof ref === 'function') ref(node);
        else if (ref) ref.current = node;

        nodeRef.current = node;
    };

    return (
        <Container timeout={timeout}>
            <CSSTransition timeout={timeout} classNames={'fade'} nodeRef={nodeRef} {...props}>
                <div ref={combinedRef} style={{ width: '100%', height: '100%' }}>
                    {children}
                </div>
            </CSSTransition>
        </Container>
    );
});
Fade.displayName = 'Fade';

export default Fade;
