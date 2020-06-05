import React, { useState, useEffect } from "react";
import { getUser, removeUserSession } from "../Utils/Common";
import axios from "axios";
import { IoIosPersonAdd } from "react-icons/io";
import CreateUser from "../components/CreateUser";
import ClientItem from "../components/ClientItem";
import CustomModalCreate from "../components/CustomModalCreate";
var moment = require("moment");

function Dashboard(props) {
  const user = getUser();
  const [clients, setClients] = useState([]);
  const [authLoading, setAuthLoading] = useState(true);
  const [modalIsOpenCreate, setIsOpenCreate] = useState(false);
  const [isOpenEdit, setIsOpenEdit] = useState(false);

  useEffect(() => {
    handleGetClients();
  }, []);

  const handleGetClients = () => {
    axios
      .get(`http://127.0.0.1:8000/api/cliente/read.php?idusuario=${user.id}`)
      .then((response) => {
        setClients(response.data.clientes);
        setAuthLoading(false);
      })
      .catch((error) => {
        setAuthLoading(false);
      });
  };

  const handleDelete = (id) => {
    axios
      .post(`http://127.0.0.1:8000/api/cliente/delete.php`, { id: id })
      .then((response) => {
        handleGetClients();
        alert("Cliente deletado");
      })
      .catch((error) => {
        console.log(error);
      });
  };

  const handleAddClient = (client) => {
    client.data_nascimento = moment(
      client.data_nascimento,
      "DD/MM/yyyy"
    ).format("yyyy-MM-DD 00:00:00");

    axios
      .post(`http://127.0.0.1:8000/api/cliente/create.php`, client)
      .then((response) => {
        alert("Cliente Criado");
        setIsOpenCreate(false);
        handleGetClients();
      })
      .catch((error) => {
        console.log(error);
      });
  };

  const handleEditClient = (client) => {
    client.data_nascimento = moment(
      client.data_nascimento,
      "DD/MM/yyyy"
    ).format("yyyy-MM-DD 00:00:00");

    axios
      .post(`http://127.0.0.1:8000/api/cliente/update.php`, client)
      .then((response) => {
        alert("Cliente Editado");
        setIsOpenEdit(false);
        handleGetClients();
      })
      .catch((error) => {
        console.log(error);
      });
  };

  const openModal = () => {
    setIsOpenCreate(true);
  };

  const closeModal = () => {
    setIsOpenCreate(false);
  };

  const openModalEdit = () => {
    setIsOpenEdit(true);
  };

  const closeModalEdit = () => {
    setIsOpenEdit(false);
  };

  const presentClient = () => {
    return clients.length ? (
      clients.map((cliente) => (
        <ClientItem
          key={cliente.id}
          isOpen={isOpenEdit}
          handleDelete={handleDelete}
          handleEditClient={handleEditClient}
          openModal={openModalEdit}
          closeModal={closeModalEdit}
          cliente={cliente}
        />
      ))
    ) : (
      <h3>Nenhum cliente cadastrado!</h3>
    );
  };

  if (authLoading) {
    return <div className="content">Loading clients...</div>;
  }

  return (
    <div className="dashboardContainer">
      <div className="titleContainer">
        <div className="titleContainerTitle">
          <h1 className="title">Bem vindo {user.nome}!</h1>
        </div>
        <div className="titleContainerButton">
          <CustomModalCreate
            openModal={openModal}
            isOpen={modalIsOpenCreate}
            closeModal={closeModal}
            button={<IoIosPersonAdd className="icon" />}
          >
            <CreateUser
              closeModal={closeModal}
              createClient={handleAddClient}
            />
          </CustomModalCreate>
        </div>
      </div>

      <br />
      {presentClient()}
    </div>
  );
}

export default Dashboard;
