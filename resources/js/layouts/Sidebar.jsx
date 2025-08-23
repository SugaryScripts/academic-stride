import { LayoutDashboard, FileText, Globe, LogOut } from 'lucide-react';
import { Link, usePage } from '@inertiajs/react';

const NavItem = ({ icon: Icon, text, route }) => {

  const { url } = usePage();
  const isActive = url === route;

  return (
    <Link
      href={route}
      className={`flex items-center space-x-4 p-3 rounded-lg transition-colors duration-200 ${
        isActive ? 'bg-red-50 text-red-500 font-semibold' : 'text-gray-600 hover:bg-gray-100'
      }`}
    >
      <Icon className="w-6 h-6" />
      <span className="text-sm">{text}</span>
    </Link>
  );
};

export default function Sidebar() {
  return (
    <div className="w-64 bg-white h-full border-r border-gray-200 p-6">
      <div className="flex items-center space-x-2 mb-8">
        <img src="logo/icon.svg" />
        <span className="bg-green-100 text-green-700 text-xs font-medium px-2 py-0.5 rounded-full ml-2">
          v0.0.1
        </span>
      </div>

      <div className="space-y-6">
        <h3 className="text-xs font-semibold uppercase text-gray-400 tracking-wider">
          Navigation
        </h3>
        <div className="space-y-2">
          <NavItem icon={LayoutDashboard} text="My Exam" route="/my-exam" />
          <NavItem icon={FileText} text="Recent Exam" route="/recent-exam" />
          <NavItem icon={FileText} text="Grade Overall" route="/grade-exam" />
          <NavItem icon={LogOut} text="Log Out" route="/logout" />
        </div>
      </div>
    </div>
  );
}
