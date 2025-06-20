import React from 'react';
import SearchContainer from '@/components/dashboard/search/SearchContainer';

interface NavbarProps {
    children: React.ReactChild | React.ReactFragment | React.ReactPortal;
}

export default ({ children }: NavbarProps) => {
  return (
    <header className="fixed top-0 left-0 w-full h-16 bg-gray-700 border-b border-gray-600 shadow backdrop-blur-lg z-50">
      <div className="max-w-screen-2xl mx-auto flex items-center justify-between h-full px-4 sm:px-6 md:px-8">
        
        <div className="flex items-center gap-4">
          {children}
        </div>
      <div className="flex grow-0 shrink-0 md:basis-56 order-last justify-end">
        <SearchContainer />
      </div>
      </div>
    </header>
  );
};

