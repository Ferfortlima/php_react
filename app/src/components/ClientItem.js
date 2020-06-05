import React, { useState } from "react";
import { IoIosTrash, IoMdCreate } from "react-icons/io";
import EditUser from "./EditUser";
import CustomModalEdit from "../components/CustomModalEdit";

var moment = require("moment");

const ClientItem = (props) => {
  const [cliente, setCliente] = useState(props.cliente);

  const handleDelete = () => {
    props.handleDelete(cliente.id);
  };

  const handleEnderecos = (enderecos) => {
    if (enderecos.length) {
      return enderecos.map((endereco) => (
        <div key={`${endereco.id}${endereco.rua}`}>
          <li key={`${endereco.id}${endereco.rua}${endereco.numero}`}>
            <a>
              {endereco.rua}, {endereco.numero}, {endereco.bairro} -{" "}
              {endereco.cep} {endereco.cidade}/{endereco.estado}
            </a>
          </li>
        </div>
      ));
    } else {
      return <a>Nenhum endereço cadastrado</a>;
    }
  };

  const handleOpenModal = () => {
    props.openModal();
  };

  const handleCloseModal = () => {
    props.closeModal();
  };

  const handleEditClient = (cliente) => {
    props.handleEditClient(cliente);
  };

  return (
    <div key={`${cliente.id}${cliente.cpf}`} className="clienteContainer">
      <div
        key={`${cliente.id}${cliente.cpf}${cliente.rg}`}
        className="clienteContainerItem"
      >
        <h3>{cliente.nome}</h3>
        <div>
          <div>
            <a className="nameInfo">CPF:</a> {cliente.cpf}
          </div>
          <br />

          <div>
            <a className="nameInfo">RG:</a> {cliente.rg}
          </div>
          <br />

          <div>
            <a className="nameInfo">TELEFONE:</a> {cliente.telefone}
          </div>
          <br />

          <div>
            <a className="nameInfo">DATA DE NASCIMENTO:</a>{" "}
            {moment(cliente.data_nascimento).format("DD/MM/yyy")}
          </div>
          <br />
        </div>
        <a className="nameInfo">ENDEREÇOS:</a>
        <br />
        {handleEnderecos(cliente.enderecos)}
      </div>
      <div className="botoesContainer">
        <button className="button" onClick={handleOpenModal}>
          <IoMdCreate className="icon" />
        </button>

        <div>
          <button className="button" onClick={handleDelete}>
            <IoIosTrash className="icon" />
          </button>
        </div>
      </div>
      <CustomModalEdit
        handleEditClient={handleEditClient}
        openModal={handleOpenModal}
        closeModal={handleCloseModal}
        isOpen={props.isOpen}
        cliente={cliente}
      />
    </div>
  );
};

export default ClientItem;
