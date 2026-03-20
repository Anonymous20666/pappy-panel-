import React, { lazy, type ReactNode } from 'react';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import { StoreProvider } from 'easy-peasy';
import { store } from '@/state';
import { SiteSettings } from '@/state/settings';
import { ReviactylSettings } from '@/state/reviactyl';
import ProgressBar from '@/components/elements/ProgressBar';
import { NotFound } from '@/components/elements/ScreenBlock';
import tw from 'twin.macro';
import GlobalStylesheet from '@/assets/css/GlobalStylesheet';
import AuthenticatedRoute from '@/components/elements/AuthenticatedRoute';
import { ServerContext } from '@/state/server';
import '@/assets/tailwind.css';
import Spinner from '@/components/elements/Spinner';
import { ThemeLoader } from '@/reviactyl/ui/ThemeEngine';
import { Invert } from '@/reviactyl/ui/SmartInvert';
import { LocaleLoader } from '@/reviactyl/ui/LanguageSwitcher';

const DashboardRouter = lazy(() => import('@/routers/DashboardRouter'));
const ServerRouter = lazy(() => import('@/routers/ServerRouter'));
const AuthenticationRouter = lazy(() => import('@/routers/AuthenticationRouter'));
const PublicServerStatus = lazy(() => import('@/components/public/PublicServerStatus'));

interface ExtendedWindow extends Window {
    SiteConfiguration?: SiteSettings;
    ReviactylConfiguration?: ReviactylSettings;
    PanelUser?: {
        uuid: string;
        username: string;
        name_first: string;
        name_last: string;
        email: string;
        root_admin: boolean;
        use_totp: boolean;
        language: string;
        editor: string;
        updated_at: string;
        created_at: string;
    };
}

// setupInterceptors(history);

// Wrapper components for React 19 compatibility with easy-peasy v4
// I wasn't sure if I should update easy-peasy or just do this, so consider this a temporary duct-tape solution.
// Brijesh if you're reading this, consider if updating easy-peasy breaks compatibility and if not, update it.
const StoreProviderWrapper = ({ children }: { children: ReactNode }) => {
    const Provider = StoreProvider as unknown as React.ComponentType<{ store: typeof store; children: ReactNode }>;
    return <Provider store={store}>{children}</Provider>;
};

const ServerContextProviderWrapper = ({ children }: { children: ReactNode }) => {
    const Provider = ServerContext.Provider as unknown as React.ComponentType<{ children: ReactNode }>;
    return <Provider>{children}</Provider>;
};

function App() {
    const { PanelUser, SiteConfiguration, ReviactylConfiguration } = window as ExtendedWindow;
    if (PanelUser && !store.getState().user.data) {
        store.getActions().user.setUserData({
            uuid: PanelUser.uuid,
            username: PanelUser.username,
            name_first: PanelUser.name_first,
            name_last: PanelUser.name_last,
            email: PanelUser.email,
            language: PanelUser.language,
            rootAdmin: PanelUser.root_admin,
            useTotp: PanelUser.use_totp,
            createdAt: new Date(PanelUser.created_at),
            fileEditor: PanelUser.editor,
            updatedAt: new Date(PanelUser.updated_at),
        });
    }

    if (!store.getState().settings.data) {
        store.getActions().settings.setSettings(SiteConfiguration!);
    }

    if (!store.getState().reviactyl.data) {
        store.getActions().reviactyl.setReviactyl(ReviactylConfiguration!);
    }

    return (
        <Invert>
            <GlobalStylesheet />
            <StoreProviderWrapper>
                <ThemeLoader />
                <LocaleLoader />
                <ProgressBar />
                <div css={tw`mx-auto w-auto`}>
                    <BrowserRouter
                        future={{
                            v7_startTransition: true,
                            v7_relativeSplatPath: true,
                        }}
                    >
                        <Routes>
                            <Route
                                path='/auth/*'
                                element={
                                    <Spinner.Suspense>
                                        <AuthenticationRouter />
                                    </Spinner.Suspense>
                                }
                            />
                            <Route
                                path='/server/:id/*'
                                element={
                                    <AuthenticatedRoute>
                                        <Spinner.Suspense>
                                            <ServerContextProviderWrapper>
                                                <ServerRouter />
                                            </ServerContextProviderWrapper>
                                        </Spinner.Suspense>
                                    </AuthenticatedRoute>
                                }
                            />
                            <Route
                                path='/status/:id/*'
                                element={
                                    <Spinner.Suspense>
                                        <PublicServerStatus />
                                    </Spinner.Suspense>
                                }
                            />
                            <Route
                                path='/*'
                                element={
                                    <AuthenticatedRoute>
                                        <Spinner.Suspense>
                                            <DashboardRouter />
                                        </Spinner.Suspense>
                                    </AuthenticatedRoute>
                                }
                            />
                            <Route path='*' element={<NotFound />} />
                        </Routes>
                    </BrowserRouter>
                </div>
            </StoreProviderWrapper>
        </Invert>
    );
}

export { App };
