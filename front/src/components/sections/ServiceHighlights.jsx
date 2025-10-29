import { Fragment } from 'react';
import PrimaryButton from '../ui/PrimaryButton.jsx';

const fallbackServices = [
  {
    id: 'talent-suite',
    title: 'مدیریت جذب و استقرار',
    description:
      'گردش‌کار استخدام، بررسی سوابق و تحویل تجهیزات به صورت خودکار با قابلیت تعریف فرم‌های اختصاصی.',
    link: '/modules/talent-suite'
  },
  {
    id: 'performance',
    title: 'ارزیابی عملکرد و رشد',
    description:
      'طراحی چرخه‌های ارزیابی، ثبت اهداف OKR و ارائه گزارش‌های تحلیلی برای مدیران و کارمندان.',
    link: '/modules/performance'
  },
  {
    id: 'payroll',
    title: 'حقوق و دستمزد پیشرفته',
    description:
      'محاسبه خودکار حقوق، مزایا و مالیات با اتصال به اطلاعات قرارداد و حضور و غیاب سازمان.',
    link: '/modules/payroll'
  }
];

const ServiceHighlights = ({ services, loading, error }) => {
  const renderedServices = services.length ? services : fallbackServices;

  return (
    <section className="services" id="services">
      <div className="container">
        <div className="section-header">
          <h2>ماژول‌های پیشنهادی مبین HR</h2>
          <p>با انتخاب هر ماژول می‌توانید دقیقاً مطابق ساختار سازمان خود سامانه را پیکربندی کنید.</p>
        </div>
        {error && <div className="alert alert-error">{error}</div>}
        <div className="service-grid">
          {renderedServices.map((service) => {
            const link = service.link || (service.id ? `/modules/${service.id}` : '#contact');
            return (
              <article key={service.id || service.title} className="service-card">
                <h3>{service.title}</h3>
                <p>{service.description}</p>
                <div className="service-card__cta">
                  <PrimaryButton as="a" href={link}>
                    مشاهده جزئیات
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
