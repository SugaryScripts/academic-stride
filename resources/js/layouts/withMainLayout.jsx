import React, { useState } from 'react';
import Sidebar from './Sidebar';
import { Menu } from 'lucide-react';

const withMainLayout = (WrappedComponent, hideSidebar = false) => {
  return (props) => {
    const [isSidebarOpen, setIsSidebarOpen] = useState(!hideSidebar);

    const toggleSidebar = () => {
      setIsSidebarOpen(!isSidebarOpen);
    };

    const sidebarClass = isSidebarOpen ? 'translate-x-0' : '-translate-x-full mr-0';
    const mainContentClass = isSidebarOpen && !hideSidebar ? 'ml-64' : 'ml-0';

    return (
      <div className="flex bg-gray-100 min-h-screen">
        {!hideSidebar && (
          <div
            className={`transform transition-transform duration-300 ease-in-out ${sidebarClass} fixed inset-y-0 left-0 z-50`}
          >
            <Sidebar />
          </div>
        )}

        <div
          className={`flex-1 flex flex-col transition-all duration-300 ease-in-out ${mainContentClass}`}
        >
          <header className="bg-white shadow-md p-4 flex items-center justify-between">
            {!hideSidebar && (
              <button
                onClick={toggleSidebar}
                className="p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-inset focus:ring-red-500"
              >
                <Menu className="h-6 w-6" />
              </button>
            )}
            <div className="flex items-center justify-center space-x-2 rounded-full w-10 h-10 bg-gray-300">
              <span className="text-sm font-semibold text-gray-800">P</span>
            </div>
          </header>

          <main className="flex-1 p-8">
            <WrappedComponent {...props} />
          </main>
        </div>
      </div>
    );
  };
};

export default withMainLayout;
