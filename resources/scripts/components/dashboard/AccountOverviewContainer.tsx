import * as React from 'react';
import { useState } from 'react';
import UpdatePasswordForm from '@/components/dashboard/forms/UpdatePasswordForm';
import UpdateEmailAddressForm from '@/components/dashboard/forms/UpdateEmailAddressForm';
import ConfigureTwoFactorForm from '@/components/dashboard/forms/ConfigureTwoFactorForm';
import tw from 'twin.macro';
import { breakpoint } from '@/theme';
import styled from 'styled-components/macro';
import MessageBox from '@/components/MessageBox';
import { useLocation } from 'react-router-dom';
import ContentBlock from '@/components/ui/ContentBlock';
import Card from '@/components/ui/Card';
import Gravatar from '@/components/ui/Avatar';
import { useStoreState } from 'easy-peasy';
import { ApplicationStore } from '@/state';
import TitledGreyBox from '../elements/TitledGreyBox';
import Title from '@/components/ui/Title';
import { ExternalLinkIcon, LogoutIcon } from '@heroicons/react/solid';
import http from '@/api/http';
import ThemeSelector from '@/components/ui/ThemeEngine';
import SpinnerOverlay from '@/components/elements/SpinnerOverlay';

const Container = styled.div`
    ${tw`flex flex-wrap`};

    & > div {
        ${tw`w-full`};

        ${breakpoint('sm')`
      width: calc(50% - 1rem);
    `}

        ${breakpoint('md')`
      ${tw`w-auto flex-1`};
    `}
    }
`;

export default () => {
    const { state } = useLocation<undefined | { twoFactorRedirect?: boolean }>();
    const nameFirst = useStoreState(state => state.user.data?.name_first);
    const nameLast = useStoreState(state => state.user.data?.name_last);
    const rootAdmin = useStoreState((state) => state.user.data!.rootAdmin);
    const name = useStoreState((state: ApplicationStore) => state.settings.data!.name);
    const [isLoggingOut, setIsLoggingOut] = useState(false);
    const themeSelector = useStoreState((state) => state.revix.data!.themeSelector);
    const onTriggerLogout = () => {
        setIsLoggingOut(true);
        http.post('/auth/logout').finally(() => {
            // @ts-expect-error this is valid
            window.location = '/';
        });
    };

    return (
        <ContentBlock title={'Account Overview'}>
            {state?.twoFactorRedirect && (
                <MessageBox title={'2-Factor Required'} type={'error'}>
                    Your account must have two-factor authentication enabled in order to continue.
                </MessageBox>
            )}

            <Container css={[tw`grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4`]}>
                <div className={'flex flex-col gap-4'}>
                <Card className="overflow-hidden">
                    <SpinnerOverlay visible={isLoggingOut} />
                        <div className="flex flex-col items-center py-8">
                            <Gravatar className="w-24 h-24 mb-3 shadow-lg" />
                            <Title className="mb-1 text-2xl">
                                {nameFirst} {nameLast}
                            </Title>
                            <div className={"flex items-center gap-x-1"}>
                            <span className="text-sm text-gray-400">
                                {rootAdmin ? 'Administrator' : {name} + 'User'}
                            </span>
                {rootAdmin && (
                  // eslint-disable-next-line react/jsx-no-target-blank
                  <a href={`/admin`} target={'_blank'} className="h-5 w-5">
                    <ExternalLinkIcon />
                  </a>
                )}
                </div>
                            <div className="mt-1">
                            <button className="flex items-center space-x-1" onClick={onTriggerLogout}>
                                <span className="text-danger/80">Logout</span> <LogoutIcon className="w-5 h-5 text-danger/80" />
                            </button>
                            </div>
                        </div>
                </Card>
                <TitledGreyBox title={'Update Email Address'} showFlashes={'account:email'}>
                    <UpdateEmailAddressForm />
                </TitledGreyBox>
                {themeSelector ?
                <TitledGreyBox title={'Theme Selector'}>
                    <ThemeSelector />
                </TitledGreyBox>
                : ''}
                </div>
                <div className={'flex flex-col gap-4'}>
                <TitledGreyBox title={'Update Password'} showFlashes={'account:password'}>
                    <UpdatePasswordForm />
                </TitledGreyBox>
                <TitledGreyBox title={'Two-Step Verification'}>
                    <ConfigureTwoFactorForm />
                </TitledGreyBox>
                </div>
            </Container>
        </ContentBlock>
    );
};
