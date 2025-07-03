import React, { useState } from 'react';
import NewDirectoryDialog from '@/components/server/files/NewDirectoryDialog';
import { Button } from '@/components/elements/button';

export default ({ className }: { className?: string }) => {
    const [visible, setVisible] = useState(false);

    return (
        <>
            <NewDirectoryDialog visible={visible} onDismissed={() => setVisible(false)} />
            <Button.Text onClick={() => setVisible(true)} className={className}>
                Create Directory
            </Button.Text>
        </>
    );
};
