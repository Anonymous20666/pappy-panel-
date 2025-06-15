import React from 'react';
import classNames from 'classnames';
import tw from 'twin.macro';
import styled from 'styled-components/macro';

interface TextProps {
    className?: string;
    children: React.ReactChild | React.ReactFragment | React.ReactPortal;
}

const Gradient = styled.div`
    ${tw`leading-tight font-semibold bg-gradient-to-br from-gray-50 via-gray-100 to-gray-200 bg-clip-text text-transparent`}
`;

export const GradientTitle = ({ className, children }: TextProps) => (
    <Gradient
        className={classNames('text-3xl pb-3', className)}
    >
        {children}
    </Gradient>
);
