import React, { useState } from "react";
import axios from "axios";
import { setUserSession } from "../Utils/Common";

function Login(props) {
  const [loading, setLoading] = useState(false);
  const username = useFormInput("user1@email.com");
  const password = useFormInput("teste123");
  const [error, setError] = useState(null);

  // handle button click of login form
  const handleLogin = () => {
    setError(null);
    setLoading(true);
    axios
      .post(
        "http://127.0.0.1:8000/api/usuario/login.php",
        {
          email: username.value,
          senha: password.value,
        },
        {
          headers: { "Content-Type": "application/json" },
        }
      )
      .then((response) => {
        setLoading(false);
        setUserSession(response.data.jwt, response.data.usuario);
        props.history.push("/dashboard");
      })
      .catch((error) => {
        setLoading(false);
        console.log(error);
        // if (error.response.status === 401) setError(error.response.data.message);
        // else setError("Something went wrong. Please try again later.");
      });
  };

  return (
    <div className="screen">
      <div className="loginContainer">
        <h1>Login</h1>
        <div className="inputContainer">
          <a className="inputText">E-mail</a>
          <input type="text" {...username} autoComplete="new-password" />
        </div>
        <div className="inputContainer">
          <a className="inputText">Senha</a>
          <input type="password" {...password} autoComplete="new-password" />
        </div>
        {error && (
          <>
            <small style={{ color: "red" }}>{error}</small>
            <br />
          </>
        )}
        <br />
        <input
          type="button"
          value={loading ? "Loading..." : "Login"}
          onClick={handleLogin}
          disabled={loading}
        />
        <br />
      </div>
    </div>
  );
}

const useFormInput = (initialValue) => {
  const [value, setValue] = useState(initialValue);

  const handleChange = (e) => {
    setValue(e.target.value);
  };
  return {
    value,
    onChange: handleChange,
  };
};

export default Login;
