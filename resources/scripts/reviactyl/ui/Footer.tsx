import styled from 'styled-components';
import tw from 'twin.macro';
import { useStoreState } from 'easy-peasy';
import Md2React from '@/reviactyl/ui/Md2React';

const Container = styled.div`
    ${tw`mt-4 mb-4`}
`;

const Copyright = styled.div`
    ${tw`text-center text-gray-400 text-xs`}
`;

export default () => {
    const customCopyright = useStoreState((state) => state.reviactyl.data!.customCopyright);
    const copyright = useStoreState((state) => state.reviactyl.data!.copyright);
    return (
        <Container>
            <Copyright>
                <a
                    rel={'noopener nofollow noreferrer'}
                    href={'http://merlinclanhosting.duckdns.org'}
                    target={'_blank'}
                    css={tw`no-underline text-gray-400 hover:text-purple-400 transition-colors`}
                >
                    ⚡ MerlinHost
                </a>
                &nbsp;&copy; {new Date().getFullYear()} — Next-Gen Cloud Hosting
            </Copyright>
            {customCopyright ? (
                <Copyright>
                    <Md2React markdown={copyright} />
                </Copyright>
            ) : (
                ''
            )}
        </Container>
    );
};
