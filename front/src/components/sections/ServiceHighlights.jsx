import { Fragment } from 'react';
import PrimaryButton from '../ui/PrimaryButton.jsx';

const fallbackServices = [
  {
    id: 'cloud-hosting',
    title: 'هاست ابری ایران',
    description: 'هاست بر پایه زیرساخت ابری با سرعت بالا و منابع اختصاصی برای سایت‌های وردپرسی.',
    link: '/services/cloud-hosting'
  },
  {
    id: 'vps',
    title: 'سرور مجازی ابری',
    description: 'سرورهای ابری NVMe با امکان افزایش منابع به صورت آنی و پنل مدیریتی فارسی.',
    link: '/services/vps'
  },
  {
    id: 'dedicated',
    title: 'سرور اختصاصی',
    description: 'سرورهای اختصاصی در دیتاسنترهای معتبر اروپایی با پورت گیگابیتی و آپتایم ۹۹.۹٪.',
    link: '/services/dedicated'
  }
];

const ServiceHighlights = ({ services, loading, error }) => {
  const renderedServices = services.length ? services : fallbackServices;

  return (
    <section className="services" id="services">
      <div className="container">
        <div className="section-header">
          <h2>خدمات پیشنهادی مبین هاست</h2>
          <p>تنوع کامل سرویس‌ها برای تمام نیازهای میزبانی، از استارتاپ تا سازمان‌های بزرگ.</p>
        </div>
        {error && <div className="alert alert-error">{error}</div>}
        <div className="service-grid">
          {renderedServices.map((service) => {
            const link = service.link || (service.id ? `/services/${service.id}` : '#contact');
            return (
              <article key={service.id || service.title} className="service-card">
                <h3>{service.title}</h3>
                <p>{service.description}</p>
                <div className="service-card__cta">
                  <PrimaryButton as="a" href={link}>
                    جزئیات بیشتر
                  </PrimaryButton>
                </div>
              </article>
            );
          })}
        </div>
        {loading && (
          <Fragment>
            <div className="loader" aria-hidden="true" />
            <p className="loading-hint">در حال دریافت اطلاعات از API...</p>
          </Fragment>
        )}
      </div>
    </section>
  );
};

export default ServiceHighlights;
