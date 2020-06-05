import React, { useState, useEffect } from "react";
import { BrowserRouter, Switch, Route, NavLink } from "react-router-dom";
import axios from "axios";
import { IoIosLogOut } from "react-icons/io";

import Login from "./pages/Login";
import Dashboard from "./pages/Dashboard";
import Home from "./pages/Home";

import PrivateRoute from "./Utils/PrivateRoute";
import PublicRoute from "./Utils/PublicRoute";
import { getToken, removeUserSession, setUserSession } from "./Utils/Common";

const App = (props) => {
  const [authLoading, setAuthLoading] = useState(true);

  useEffect(() => {
    const token = getToken();
    if (!token) {
      return;
    }

    axios
      .post(
        `http://127.0.0.1:8000/api/usuario/validate_token.php`,
        {
          jwt: token,
        },
        {
          headers: { "Content-Type": "application/json" },
        }
      )
      .then((response) => {
        setUserSession(response.data.jwt, response.data.usuario);
        setAuthLoading(false);
      })
      .catch((error) => {
        removeUserSession();
        setAuthLoading(false);
      });
  }, []);

  const handleLogout = () => {
    removeUserSession();
    props.history.push("/login");
  };

  if (authLoading && getToken()) {
    return <div className="content">Checking Authentication...</div>;
  }

  return (
    <div className="App">
      <BrowserRouter>
        <div>
          <div className="headerContainer">
            <div className="header">
              <div>
                <NavLink exact activeClassName="active" to="/">
                  Home
                </NavLink>
                <NavLink activeClassName="active" to="/login">
                  Login
                </NavLink>
                <NavLink activeClassName="active" to="/dashboard">
                  Dashboard
                </NavLink>
              </div>

              <div>
                <button className="buttonLogout" onClick={handleLogout}>
                  <IoIosLogOut className="iconLogout" />
                </button>
              </div>
            </div>
          </div>
          <div className="content">
            <Switch>
              <Route exact path="/" component={Home} />
              <PublicRoute path="/login" component={Login} />
              <PrivateRoute path="/dashboard" component={Dashboard} />
            </Switch>
          </div>
        </div>
      </BrowserRouter>
    </div>
  );
};

export default App;
