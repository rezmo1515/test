import DashboardIcon from '../svg/DashboardIcon.jsx';
import EmployeesIcon from '../svg/EmployeesIcon.jsx';
import CalendarIcon from '../svg/CalendarIcon.jsx';
import SettingsIcon from '../svg/SettingsIcon.jsx';
import LogoutIcon from '../svg/LogoutIcon.jsx';
import SupportIcon from '../svg/SupportIcon.jsx';
import { useAuth } from '../../context/AuthContext.jsx';

const menuItems = [
  { id: 'dashboard', label: 'پیشخوان', icon: DashboardIcon, href: '/dashboard' },
  { id: 'employees', label: 'کارکنان', icon: EmployeesIcon, href: '/employees' },
  { id: 'attendance', label: 'حضور و غیاب', icon: CalendarIcon, href: '/attendance' },
  { id: 'settings', label: 'تنظیمات', icon: SettingsIcon, href: '/settings' }
];

const Sidebar = ({ active }) => {
  const { logout, user } = useAuth();

  return (
    <aside className="sidebar">
      <div className="sidebar-header">
        <div className="sidebar-brand">
          <span className="brand-logo" aria-hidden="true">م</span>
          <div>
            <strong>مبین هاست</strong>
            <span>سامانه مدیریت منابع انسانی</span>
          </div>
        </div>
      </div>
      <nav className="sidebar-menu" aria-label="منوی اصلی">
        {menuItems.map(({ id, label, icon: Icon, href }) => (
          <a
            key={id}
            className={`sidebar-link ${active === id ? 'is-active' : ''}`}
            href={href}
          >
            <Icon />
            <span>{label}</span>
          </a>
        ))}
      </nav>
      <div className="sidebar-footer">
        <a className="sidebar-link" href="mailto:admin@mobinhost.com">
          <SupportIcon />
          <span>پشتیبانی</span>
        </a>
        <button type="button" className="sidebar-link" onClick={logout}>
          <LogoutIcon />
          <span>خروج</span>
        </button>
        {user && (
          <div className="sidebar-user">
            <span className="user-initials">{user.username?.slice(0, 1)?.toUpperCase() || 'ک'}</span>
            <div>
              <strong>{user.username || 'کاربر سیستم'}</strong>
              <span>{user.email}</span>
            </div>
          </div>
        )}
      </div>
    </aside>
  );
};

export default Sidebar;
