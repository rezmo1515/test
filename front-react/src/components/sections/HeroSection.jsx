import PrimaryButton from '../ui/PrimaryButton.jsx';

const HeroSection = () => (
  <section className="hero" id="hero">
    <div className="container hero-content">
      <div className="hero-text">
        <h1>سامانه یکپارچه منابع انسانی و پرسنلی</h1>
        <p>
          مبین HR با تمرکز بر تجربه کاربری فارسی و فرآیندهای بومی، جریان کامل مدیریت کارکنان را از جذب نیرو تا
          ارزیابی عملکرد و حقوق و دستمزد دیجیتالی می‌کند.
        </p>
        <div className="hero-actions">
          <PrimaryButton as="a" href="#features">
            مشاهده ماژول‌ها
          </PrimaryButton>
          <a className="btn btn-secondary" href="#contact">
            درخواست دمو اختصاصی
          </a>
        </div>
      </div>
      <div className="hero-card">
        <div className="hero-card__title">کنترل کامل چرخه پرسنلی</div>
        <p>با اتصال مستقیم به بک‌اند لاراول، هر تغییر در اطلاعات کارکنان بلافاصله در همه ماژول‌ها همگام می‌شود.</p>
        <ul>
          <li>پشتیبانی از ساختارهای سازمانی پیچیده</li>
          <li>اتوماسیون گردش فرم‌ها و تاییدها</li>
          <li>داشبوردهای تحلیلی آماده ارائه</li>
        </ul>
      </div>
    </div>
  </section>
);

export default HeroSection;
