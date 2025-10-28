import { useState } from 'react';
import PrimaryButton from '../ui/PrimaryButton.jsx';

const navItems = [
  { label: 'خانه', href: '/' },
  { label: 'خدمات', href: '#services' },
  { label: 'ویژگی‌ها', href: '#features' },
  { label: 'ارتباط با ما', href: '#contact' }
];

const Header = () => {
  const [open, setOpen] = useState(false);

  return (
    <header className="top-header">
      <div className="container header-container">
        <div className="brand">مبین هاست</div>
        <button
          className="menu-toggle"
          type="button"
          onClick={() => setOpen((prev) => !prev)}
          aria-expanded={open}
          aria-label="باز و بسته کردن منو"
        >
          <span />
          <span />
          <span />
        </button>
        <nav className={`main-nav ${open ? 'open' : ''}`}>
          {navItems.map((item) => (
            <a key={item.label} href={item.href} onClick={() => setOpen(false)}>
              {item.label}
            </a>
          ))}
        </nav>
        <div className="header-actions">
          <PrimaryButton as="a" href="#contact">
            ورود کاربران
          </PrimaryButton>
        </div>
      </div>
    </header>
  );
};

export default Header;
