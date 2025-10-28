import PrimaryButton from '../ui/PrimaryButton.jsx';

const ContactBanner = () => (
  <section className="contact-banner">
    <div className="container contact-banner__content">
      <div>
        <h2>نیاز به راهکار اختصاصی دارید؟</h2>
        <p>
          کارشناسان ما آماده‌اند تا با بررسی زیرساخت فعلی شما، بهترین پیشنهاد را برای مهاجرت به پلتفرم ابری مبین
          هاست ارائه دهند.
        </p>
      </div>
      <PrimaryButton as="a" href="mailto:sales@mobinhost.example">
        ثبت درخواست مشاوره
      </PrimaryButton>
    </div>
  </section>
);

export default ContactBanner;
