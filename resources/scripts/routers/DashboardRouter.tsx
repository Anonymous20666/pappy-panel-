import React,{useState} from 'react';
import { NavLink, Route, Switch } from 'react-router-dom';
import NavigationBar from '@/components/NavigationBar';
import DashboardContainer from '@/components/dashboard/DashboardContainer';
import { NotFound } from '@/components/elements/ScreenBlock';
import TransitionRouter from '@/TransitionRouter';
import SubNavigation from '@/components/elements/SubNavigation';
import { useLocation } from 'react-router';
import Spinner from '@/components/elements/Spinner';
import routes from '@/routers/routes';
import { RouterContainer } from '@/components/ui/RouterContainer';
import Navbar from '@/components/ui/Navbar';
import { LogoContainer } from '@/components/ui/LogoContainer';
import { XIcon, MenuIcon } from '@heroicons/react/solid';
import tw from 'twin.macro';
import { ContentContainer } from '@/components/ui/ContentContainer';
import { CSSTransition } from 'react-transition-group';
import DashboardSidebar from '@/components/ui/sidebar/DashboardSidebar';

export default () => {
    const location = useLocation();
    const [isSidebarOpen, setSidebarOpen] = useState(false);

    return (
        <RouterContainer>
            <Navbar>
                        <div className="lg:hidden">
                             <button onClick={() => setSidebarOpen(!isSidebarOpen)} className="text-gray-500 bg-gray-700 pt-2 pb-2 pl-2 rounded-ui">
                               {isSidebarOpen ? <XIcon className="w-6 h-6" /> : <MenuIcon className="w-6 h-6" /> }
                             </button>
                        </div>
                        <LogoContainer>
                            <img src="/revix/logo.png" alt="revix" onClick={() => window.location.href = '/'} css={tw`h-[3rem] mt-5 cursor-pointer`} />
                        </LogoContainer>
            </Navbar>
            <ContentContainer>
                    {isSidebarOpen && (
                           <div 
                            onClick={() => setSidebarOpen(false)}
                            className="fixed inset-0 z-30 bg-gray-800/40 backdrop-blur-sm transition-all duration-300 ease-in-out lg:hidden"
                            />
                        )}
                    <CSSTransition timeout={150} classNames="fade">
                        <DashboardSidebar isOpen={isSidebarOpen} />
                    </CSSTransition>
                    {isSidebarOpen && (
                        <div className="lg:hidden fixed z-50 right-0 top-[68px]">
                             <button onClick={() => setSidebarOpen(!isSidebarOpen)} className="text-gray-500 bg-gray-700 p-2 rounded-l-ui">
                               <XIcon className="w-6 h-6" />
                             </button>
                        </div>
                     )}
            <div className="w-full flex-1 overflow-y-auto">
            <TransitionRouter>
                <React.Suspense fallback={<Spinner centered />}>
                    <Switch location={location}>
                        <Route path={'/'} exact>
                            <DashboardContainer />
                        </Route>
                        {routes.account.map(({ path, component: Component }) => (
                            <Route key={path} path={`/account/${path}`.replace('//', '/')} exact>
                                <Component />
                            </Route>
                        ))}
                        <Route path={'*'}>
                            <NotFound />
                        </Route>
                    </Switch>
                </React.Suspense>
            </TransitionRouter>
            </div>
            </ContentContainer>
        </RouterContainer>
    );
};
