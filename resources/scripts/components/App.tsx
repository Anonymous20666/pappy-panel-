import { lazy } from 'react';
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
const PublicServerStatus = lazy(
    () => import('@/components/public/PublicServerStatus')
);

interface ExtendedWindow extends Window {
    SiteConfiguration?: SiteSettings;
    ReviactylConfiguration?: ReviactylSettings;
    PterodactylUser?: {
        uuid: string;
        username: string;
        name_first: string;
        name_last: string;
        email: string;
        /* eslint-disable camelcase */
        root_admin: boolean;
        use_totp: boolean;
        language: string;
        editor: string;
        updated_at: string;
        created_at: string;
        /* eslint-enable camelcase */
    };
}

// setupInterceptors(history);

function App() {
    const { PterodactylUser, SiteConfiguration, ReviactylConfiguration } = window as ExtendedWindow;
    if (PterodactylUser && !store.getState().user.data) {
        store.getActions().user.setUserData({
            uuid: PterodactylUser.uuid,
            username: PterodactylUser.username,
            name_first: PterodactylUser.name_first,
            name_last: PterodactylUser.name_last,
            email: PterodactylUser.email,
            language: PterodactylUser.language,
            rootAdmin: PterodactylUser.root_admin,
            useTotp: PterodactylUser.use_totp,
            createdAt: new Date(PterodactylUser.created_at),
            fileEditor: PterodactylUser.editor,
            updatedAt: new Date(PterodactylUser.updated_at),
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
            {/* @ts-expect-error - easy-peasy has not updated types for React 19 children prop */}
            <StoreProvider store={store}>
                <ThemeLoader />
                <LocaleLoader />
                <ProgressBar />
                <div css={tw`mx-auto w-auto`}>
                    <BrowserRouter>
                        <Routes>
                            <Route path="/auth/*" element={
                                <Spinner.Suspense>
                                    <AuthenticationRouter />
                                </Spinner.Suspense>
                            } />
                            <Route
                                path="/server/:id/*"
                                element={
                                    <AuthenticatedRoute>
                                        <Spinner.Suspense>
                                            {/* @ts-expect-error - easy-peasy has not updated types for React 19 children prop */}
                                            <ServerContext.Provider>
                                                <ServerRouter />
                                            </ServerContext.Provider>
                                        </Spinner.Suspense>
                                    </AuthenticatedRoute>
                                }
                            />
                            <Route
                                path="/status/:id/*"
                                element={
                                <Spinner.Suspense>
                                    <PublicServerStatus />
                                </Spinner.Suspense>
                                }
                            />
                            <Route
                                path="/*"
                                element={
                                    <AuthenticatedRoute>
                                        <Spinner.Suspense>
                                            <DashboardRouter />
                                        </Spinner.Suspense>
                                    </AuthenticatedRoute>
                                }
                            />
                            <Route path="*" element={<NotFound />} />
                        </Routes>
                    </BrowserRouter>
                </div>
            </StoreProvider>
        </Invert>
    );
};

export { App };
