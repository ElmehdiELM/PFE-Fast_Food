
import AuthUser from '../../pages/AuthUser';
import Guest from '../../navbar/guest';
import Auth from '../../navbar/auth.js';

const Header = () => {
  const {getToken} = AuthUser();
  if(!getToken()){
    return <Guest />
  }
  return (
      <Auth />
  );
};

export default Header;
