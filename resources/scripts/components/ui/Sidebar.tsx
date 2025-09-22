import React from 'react';
import styled from 'styled-components/macro';
import tw from 'twin.macro';
import { SideNavigation } from './sidebar/SideNavigation';
import { Link, NavLink } from 'react-router-dom';
import Avatar from '@/components/ui/Avatar';
import { useStoreState } from 'easy-peasy';
import { ApplicationStore } from '@/state';
import { ServerIcon } from '@heroicons/react/solid';

interface Props {
    isOpen?: boolean;
    children?: React.ReactNode;
    dashboard?: boolean;
}

const Container = styled.div<{ isOpen: boolean }>`
  ${tw`w-[225px] self-start m-3 border border-gray-600 rounded-ui bg-gray-700 text-white flex flex-col z-40 transition-transform duration-300 ease-in-out`};

  ${({ isOpen }) => (isOpen
    ? tw`fixed top-16 left-0 translate-x-0 h-[calc(100vh-64px)] overflow-y-auto`
    : tw`-translate-x-full hidden`
  )}

  @media (min-width: 1024px) {
    position: fixed;
    top: 64px;
    left: 0;
    transform: translateX(0);
    display: flex;
    height: calc(100vh - 100px);
    overflow-y: auto;
  }
`;

const Sidebar = ({ children, isOpen = false, dashboard = false }: Props) => {
    const nameFirst = useStoreState(state => state.user.data?.name_first);
    const nameLast = useStoreState(state => state.user.data?.name_last);
    const rootAdmin = useStoreState((state) => state.user.data!.rootAdmin);
    const name = useStoreState((state: ApplicationStore) => state.settings.data!.name);
    return (
        <Container isOpen={isOpen}>
        <div className="sticky w-fit text-white p-4 rounded-ui">
                <Link to="/account" className="flex items-center gap-3">
                    <Avatar className="w-10" /> 
            <div className="flex flex-col">
                <span className="text-xs tracking-widest uppercase text-white/50">
                   {rootAdmin ? 'Administrator' : name + ' User'}
                </span>
                <span className="text-sm font-semibold">{nameFirst} {nameLast}</span>
            </div>
                </Link>
        </div>
            {dashboard && (
               <SideNavigation>
                  <NavLink to="/" exact>
                    <ServerIcon className={`w-5 mr-1`} /> Dashboard
                  </NavLink>
               </SideNavigation>
            )}
            {children && (
               <SideNavigation>
                    {children}
               </SideNavigation>
            )} 
        </Container>
    );
};

export default Sidebar;