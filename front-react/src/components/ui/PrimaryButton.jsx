const PrimaryButton = ({ children, as: Component = 'button', ...props }) => (
  <Component className="btn btn-primary" {...props}>
    {children}
  </Component>
);

export default PrimaryButton;
