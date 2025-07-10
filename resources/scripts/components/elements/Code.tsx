import React from 'react';
import classNames from 'classnames';

interface CodeProps {
    dark?: boolean | undefined;
    className?: string;
    children: React.ReactChild | React.ReactFragment | React.ReactPortal;
}

export default ({ dark, className, children }: CodeProps) => (
    <code
        className={'font-mono text-sm px-2 py-1 inline-block rounded-ui bg-gray-800 border border-gray-600'}
    >
        {children}
    </code>
);
