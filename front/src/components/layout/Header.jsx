import { useEffect, useState } from 'react';
import SearchIcon from '../svg/SearchIcon.jsx';
import NotificationIcon from '../svg/NotificationIcon.jsx';
import MenuIcon from '../svg/MenuIcon.jsx';
import { formatPersianDateTime } from '../../utils/date.js';

const Header = ({ pageTitle, breadcrumbs, user }) => {
  const [dateTime, setDateTime] = useState(formatPersianDateTime(new Date()));

  useEffect(() => {
    const timer = setInterval(() => {
      setDateTime(formatPersianDateTime(new Date()));
    }, 60000);

    return () => clearInterval(timer);
  }, []);

  return (
    <header className="topbar">
      <div className="topbar-leading">
        <button className="icon-button" type="button" aria-label="باز کردن منو">
          <MenuIcon />
        </button>
        <div>
          <h1 className="page-title">{pageTitle}</h1>
          <nav className="breadcrumbs" aria-label="مسیر دسترسی">
            {breadcrumbs.map((item, index) => (
              <span key={item.label}>
                {index > 0 && <span className="breadcrumb-separator">/</span>}
                {item.href ? <a href={item.href}>{item.label}</a> : <span>{item.label}</span>}
              </span>
            ))}
          </nav>
        </div>
      </div>

      <div className="topbar-actions">
        <div className="topbar-date" aria-live="polite">{dateTime}</div>
        <div className="search-box">
          <SearchIcon />
          <input type="search" placeholder="جستجو در سامانه" aria-label="جستجو" />
        </div>
        <button className="icon-button" type="button" aria-label="اعلان‌ها">
          <NotificationIcon />
        </button>
        {user && (
          <div className="user-chip" title={user.email}>
            <span className="user-initials">{user.username?.slice(0, 1)?.toUpperCase() || 'کاربر'}</span>
            <div className="user-meta">
              <span className="user-name">{user.username || 'کاربر سیستم'}</span>
              <span className="user-role">مدیر سامانه</span>
            </div>
          </div>
        )}
      </div>
    </header>
  );
};

export default Header;
