import PrimaryButton from '../ui/PrimaryButton.jsx';

const HeroSection = () => (
  <section className="hero" id="hero">
    <div className="container hero-content">
      <div className="hero-text">
        <h1>زیرساخت ابری مطمئن برای رشد کسب‌وکار شما</h1>
        <p>
          مبین هاست با بهره‌گیری از دیتاسنترهای معتبر ایرانی و بین‌المللی، سریع‌ترین و امن‌ترین راهکارهای
          میزبانی را برای وب‌سایت‌های پرترافیک فراهم کرده است.
        </p>
        <div className="hero-actions">
          <PrimaryButton as="a" href="#services">
            مشاهده سرویس‌ها
          </PrimaryButton>
          <a className="btn btn-secondary" href="#contact">
            درخواست مشاوره رایگان
          </a>
        </div>
      </div>
      <div className="hero-card">
        <div className="hero-card__title">پشتیبانی ۲۴/۷</div>
        <p>تیم فنی مبین هاست همیشه در کنار شماست تا کوچک‌ترین اختلال را در کمترین زمان برطرف کند.</p>
        <ul>
          <li>مانیتورینگ لحظه‌ای سرویس‌ها</li>
          <li>راهنمایی نصب و راه‌اندازی</li>
          <li>گزارش‌های دوره‌ای عملکرد</li>
        </ul>
      </div>
    </div>
  </section>
);

export default HeroSection;
