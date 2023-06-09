// import React from "react";

import React, { useRef } from "react";
// import CommonSection from "../components/UI/common-section/CommonSection";
import { Container, Row, Col } from "reactstrap";

const Contact = () => {
  const signupNameRef = useRef();
  const signupPasswordRef = useRef();
  const signupEmailRef = useRef();

  const submitHandler = (e) => {
    e.preventDefault();
  };
  return <div>
      
      {/* <CommonSection title="Signup" /> */}
      <section>
        <Container>
          <Row>
            <Col lg="6" md="6" sm="12" className="m-auto text-center">
              <h4>Contact</h4>
              <form className="form mb-5" onSubmit={submitHandler}>
                <div className="form__group">
                  <input
                    type="text"
                    placeholder="Full name"
                    required
                    ref={signupNameRef}
                  />
                </div>
                <div className="form__group">
                  <input
                    type="email"
                    placeholder="Email"
                    required
                    ref={signupEmailRef}
                  />
                </div>
                <div className="form__group">
                  <textarea
                    type="text"
                    placeholder="Massage"
                    required
                    ref={signupPasswordRef}
                  ></textarea>
                </div>
                <button type="submit" className="addTOCart__btn">
                  Send
                </button>
              </form>
            </Col>
          </Row>
        </Container>
      </section>
    
    </div>;
};

export default Contact;
