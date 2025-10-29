import React from 'react';
import classNames from 'classnames';
import Motion from './Motion';

interface CardProps {
    className?: string;
    children: React.ReactChild | React.ReactFragment | React.ReactPortal;
}

export default ({ className, children }: CardProps) => (
    <Motion className={classNames('p-5 rounded-ui bg-gray-700 border border-gray-600', className)}>{children}</Motion>
);
