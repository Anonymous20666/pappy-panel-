import React from 'react';
import styled from 'styled-components/macro';
import tw from 'twin.macro';
import { SideNavigation } from './SideNavigation';
import { Link } from 'react-router-dom';
import Avatar from '@/components/ui/Avatar';

interface Props {
    isOpen?: boolean;
    children?: React.ReactNode;
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

const ServerSidebar = ({ children, isOpen = false }: Props) => {
    return (
        <Container isOpen={isOpen}>
        <div className="sticky w-fit text-white p-4 rounded-ui">
                <Link to="/account" className="flex items-center gap-3">
                    <Avatar className="w-10" /> 
            <div className="flex flex-col">
                <span className="text-xs tracking-widest uppercase text-white/50">
                    Administrator
                </span>
                <span className="text-sm font-semibold">BXD CEO</span>
            </div>
                </Link>
        </div>
            {children && (
               <SideNavigation>
                    {children}
               </SideNavigation>
            )} 
        </Container>
    );
};

export default ServerSidebar;