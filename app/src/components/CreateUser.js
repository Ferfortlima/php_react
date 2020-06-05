import React, { useState } from "react";
import { getUser } from "../Utils/Common";
import { IoIosCheckmark, IoIosClose } from "react-icons/io";
import MaskedInput from "react-text-mask";

const CreateUser = (props) => {
  const user = getUser();
  const client = props.client ? props.client : {};

  const handleCreateUser = () => {
    client.idusuario = user.id;
    client.enderecos = [];
    console.log(client);
    props.createClient(client);
  };

  const handleInput = (value) => {
    client[value.target.id] = value.target.value;
  };

  const handleCloseModal = () => {
    props.closeModal();
  };

  return (
    <div className="formContainer">
      <div>
        <h2>Criar cliente</h2>
      </div>
      <div className="formInputContainer">
        <form>
          <input
            className="inputClient"
            id="nome"
            defaultValue={client.nome}
            placeholder="Nome"
            onChange={handleInput}
          />
          <br />
          <input
            id="cpf"
            className="inputClient"
            onChange={handleInput}
            defaultValue={client.cpf}
            placeholder="CPF"
          />
          <br />
          <input
            id="rg"
            className="inputClient"
            onChange={handleInput}
            defaultValue={client.rg}
            placeholder="RG"
          />
          <br />
          <input
            id="telefone"
            className="inputClient"
            onChange={handleInput}
            defaultValue={client.telefone}
            placeholder="Telefone"
          />
          <br />

          <MaskedInput
            mask={[
              /[0-9]/,
              /[0-9]/,
              "/",
              /[0-9]/,
              /[0-9]/,
              "/",
              /[1-9]/,
              /[0-9]/,
              /[0-9]/,
              /[0-9]/,
            ]}
            className="inputClient"
            placeholder="Data de Nascimento"
            defaultValue={client.data_nascimento}
            guide={false}
            id="data_nascimento"
            onChange={handleInput}
          />
          <br />
        </form>
      </div>
      <div className="buttonContainer">
        <button className="button" onClick={handleCloseModal}>
          <IoIosClose className="icon" />
        </button>
        <button className="button" onClick={handleCreateUser}>
          <IoIosCheckmark className="icon" />
        </button>
      </div>
    </div>
  );
};

export default CreateUser;
