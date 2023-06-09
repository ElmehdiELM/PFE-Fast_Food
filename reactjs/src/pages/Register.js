import React, { useRef, useState } from "react";
import Helmet from "../components/Helmet/Helmet";
import CommonSection from "../components/UI/common-section/CommonSection";
import { Container, Row, Col } from "reactstrap";
import { Link } from "react-router-dom";
import { useNavigate } from 'react-router-dom';
import AuthUser from './AuthUser';

const Register = () => {
  const signupNameRef = useRef();
  const signupPasswordRef = useRef();
  const signupEmailRef = useRef();

  const navigate = useNavigate();
  const {http,setToken} = AuthUser();
  const [name,setName] = useState();
  const [email,setEmail] = useState();
  const [password,setPassword] = useState();

  const submitHandler = (e) => {
    // api call
    http.post('/register',{email:email,password:password,name:name}).then((res)=>{
        navigate('/login')
    })
  };

  return (
    <Helmet title="Signup">
      <CommonSection title="Signup" />
      <section>
        <Container>
          <Row>
            <Col lg="6" md="6" sm="12" className="m-auto text-center">
              <form className="form mb-5">
                <div className="form__group">
                  <input
                    type="text"
                    placeholder="Full name"
                    required
                    ref={signupNameRef}
                    onChange={e=>setName(e.target.value)}
                  />
                </div>
                <div className="form__group">
                  <input
                    type="email"
                    placeholder="Email"
                    required
                    ref={signupEmailRef}
                    onChange={e=>setEmail(e.target.value)}
                  />
                </div>
                <div className="form__group">
                  <input
                    type="password"
                    placeholder="Password"
                    required
                    ref={signupPasswordRef}
                    onChange={e => setPassword(e.target.value)}
                  />
                </div>
                <button type="button" onSubmit={submitHandler} className="addTOCart__btn">
                  Sign Up
                </button>
              </form>
              <Link to="/login">Already have an account? Login</Link>
            </Col>
          </Row>
        </Container>
      </section>
    </Helmet>
  );
};

export default Register;
