import React, { useState } from "react";
import CustomModal from "./components/Modal";

var moment = require("moment");

const ClientItem = (props) => {
  const [cliente, setCliente] = useState(props.cliente);

  const handleDelete = () => {
    handleDelete.bind(this, cliente.id);
  };
  return (
    <div key={cliente.id}>
      <div>
        <h4>{cliente.nome}</h4>
        <div>
          <a>{cliente.cpf}</a>
          <br />

          <a>{cliente.rg}</a>
          <br />

          <a>{cliente.telefone}</a>
          <br />

          <a>{moment(cliente.data_nascimento).format("DD/MM/yyy")}</a>
          <br />
        </div>
        {handleEnderecos(cliente.enderecos)}
      </div>
      <CustomModal button={<IoMdCreate className="icon" />}>
        <CreateUser function={handleEditClient} client={cliente} />
      </CustomModal>

      <button className="button" onClick={handleDelete}>
        <IoIosTrash className="icon" />
      </button>
    </div>
  );
};

export default ClientItem;
