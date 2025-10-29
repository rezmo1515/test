import PrimaryButton from './ui/PrimaryButton.jsx';

const NotFound = () => (
  <section className="not-found">
    <div className="container">
      <h1>صفحه مورد نظر یافت نشد</h1>
      <p>ممکن است آدرس صفحه تغییر کرده باشد یا به صورت موقت در دسترس نباشد.</p>
      <PrimaryButton as="a" href="/">
        بازگشت به صفحه اصلی
      </PrimaryButton>
    </div>
  </section>
);

export default NotFound;
