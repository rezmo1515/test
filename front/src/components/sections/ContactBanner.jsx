import PrimaryButton from '../ui/PrimaryButton.jsx';

const ContactBanner = () => (
  <section className="contact-banner">
    <div className="container contact-banner__content">
      <div>
        <h2>نیاز به استقرار اختصاصی دارید؟</h2>
        <p>
          تیم پیاده‌سازی مبین HR آماده است تا فرآیندهای منابع انسانی سازمان شما را تحلیل و در کمترین زمان روی
          زیرساخت لاراول سفارشی‌سازی کند.
        </p>
      </div>
      <PrimaryButton as="a" href="mailto:hr-solutions@mobin.example">
        درخواست جلسه مشاوره
      </PrimaryButton>
    </div>
  </section>
);

export default ContactBanner;
