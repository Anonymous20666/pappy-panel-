import { useState, useRef } from 'react';
import { Suspense } from 'react';
import { NavLink, useRoutes } from 'react-router-dom';
import DashboardContainer from '@/components/dashboard/DashboardContainer';
import { NotFound } from '@/components/elements/ScreenBlock';
import Spinner from '@/components/elements/Spinner';
import routes from '@/routers/routes';
import { RouterContainer } from '@/reviactyl/ui/RouterContainer';
import Navbar from '@/reviactyl/ui/Navbar';
import { LogoContainer } from '@/reviactyl/ui/LogoContainer';
import { XIcon, MenuIcon } from '@heroicons/react/solid';
import tw from 'twin.macro';
import { ContentContainer } from '@/reviactyl/ui/ContentContainer';
import { CSSTransition } from 'react-transition-group';
import Sidebar from '@/reviactyl/ui/Sidebar';
import { ApplicationStore } from '@/state';
import { useStoreState } from 'easy-peasy';
import Announcement from '@/reviactyl/ui/Announcement';
import MaintenanceAlert from '@/reviactyl/ui/MaintenanceAlert';
import QuickLinks from '@/reviactyl/ui/QuickLinks';
import Maintenance from '@/reviactyl/ui/Maintenance';
import { useTranslation } from 'react-i18next';

interface Props {
    route: any;
}

const NavItem = ({ route }: Props) => {
    const { t } = useTranslation('routes');
    const to = (value: string) => {
        return `/account/${value.replace(/^\/+/, '')}`;
    };

    return (
        <NavLink id={route.name} to={to(route.path ?? route.route)} end={route.end}>
            <span className='flex items-center'>
                {route.icon && <route.icon className={`w-5 mr-1`} />} {route.name ? t(route.name as string) : null}
            </span>
        </NavLink>
    );
};

const DashboardNavigation = () => {
    return (
        <>
            {routes.account
                .filter((route) => !!route.name)
                .map((route) => (
                    <NavItem key={route.name} route={route} />
                ))}
        </>
    );
};

function DashboardRouter() {
    const [isSidebarOpen, setSidebarOpen] = useState(false);
    const logo = useStoreState((state: ApplicationStore) => state.settings.data!.logo);
    const name = useStoreState((state: ApplicationStore) => state.settings.data!.name);
    const isUnderMaintenance = useStoreState((state) => state.reviactyl.data?.isUnderMaintenance);
    const rootAdmin = useStoreState((state) => state.user.data?.rootAdmin);
    const nodeRef = useRef(null);
    return (
        <>
            {isUnderMaintenance && !rootAdmin ? (
                <Maintenance />
            ) : (
                <RouterContainer>
                    <Navbar>
                        <div className='lg:hidden'>
                            <button
                                onClick={() => setSidebarOpen(!isSidebarOpen)}
                                className='text-gray-500 bg-gray-700 p-2 rounded-ui'
                            >
                                {isSidebarOpen ? <XIcon className='w-6 h-6' /> : <MenuIcon className='w-6 h-6' />}
                            </button>
                        </div>
                        <LogoContainer>
                            <img
                                src={logo}
                                alt={name}
                                onClick={() => (window.location.href = '/')}
                                css={tw`h-[3rem] mt-5 cursor-pointer`}
                            />
                        </LogoContainer>
                    </Navbar>
                    <ContentContainer>
                        {isSidebarOpen && (
                            <div
                                onClick={() => setSidebarOpen(false)}
                                className='fixed inset-0 z-30 bg-gray-800/40 backdrop-blur-sm transition-all duration-300 ease-in-out lg:hidden'
                            />
                        )}
                        <CSSTransition timeout={150} classNames='fade' nodeRef={nodeRef}>
                            <Sidebar isOpen={isSidebarOpen} dashboard ref={nodeRef}>
                                <DashboardNavigation />
                            </Sidebar>
                        </CSSTransition>
                        <div className='w-full flex-1 overflow-y-auto'>
                            <Suspense fallback={<Spinner centered />}>
                                {useRoutes([
                                    {
                                        path: '',
                                        element: (
                                            <>
                                                <Announcement />
                                                <MaintenanceAlert />
                                                <QuickLinks />
                                                <DashboardContainer />
                                            </>
                                        ),
                                    },
                                    ...routes.account.map(({ route, component: Component }) => ({
                                        path: `/account/${route}`.replace('//', '/'),
                                        element: <Component />,
                                    })),
                                    { path: '*', element: <NotFound /> },
                                ])}
                            </Suspense>
                        </div>
                    </ContentContainer>
                </RouterContainer>
            )}
        </>
    );
}

export default DashboardRouter;
