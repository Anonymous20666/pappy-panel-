import React, { forwardRef } from 'react';
import { Form } from 'formik';
import styled from 'styled-components/macro';
import FlashMessageRender from '@/components/FlashMessageRender';
import Card from '@/components/ui/Card'
import Title from '@/components/ui/Title';
import tw from 'twin.macro';

type Props = React.DetailedHTMLProps<React.FormHTMLAttributes<HTMLFormElement>, HTMLFormElement> & {
    title?: string;
};

const Container = styled.div`
    ${tw`my-auto mx-auto`}
`;

const CardContainer = styled.div`
    ${tw`max-w-[28.125rem] w-screen p-5`}
`;

export default forwardRef<HTMLFormElement, Props>(({ title, ...props }, ref) => (
    <Container>
        <FlashMessageRender css={tw`mb-2 px-1`} />
        <Form {...props} ref={ref}>
          <CardContainer>
            <div className='flex gap-x-2 items-center content-center font-semibold text-lg text-gray-50 pb-5'>
             <img src="/revix/logo.png" alt="revix" css={`height:50px;`} />
            </div>
            <Card>
                {title && <Title className="text-3xl text-center pb-3">{title}</Title>}
                {props.children}
            </Card>
          </CardContainer>
        </Form>
        <p css={tw`text-center text-neutral-500 text-xs mt-4`}>
            &copy; 2015 - {new Date().getFullYear()}&nbsp;
            <a
                rel={'noopener nofollow noreferrer'}
                href={'https://pterodactyl.io'}
                target={'_blank'}
                css={tw`no-underline text-neutral-500 hover:text-neutral-300`}
            >
                Pterodactyl Software
            </a>
        </p>
    </Container>
));
