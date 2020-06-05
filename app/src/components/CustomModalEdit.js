import React, { useState, useEffect } from "react";
import Modal from "react-modal";
import EditUser from "./EditUser";

const customStyles = {
  content: {
    top: "50%",
    left: "50%",
    right: "auto",
    bottom: "auto",
    marginRight: "-50%",
    transform: "translate(-50%, -50%)",
    backgroundColor: "#ddd",
    width: "300px",
    display: "flex",
    justifyContent: "center",
    flex: 1,
  },
};

const CustomModalEdit = (props) => {
  const handleOpenModal = () => {
    props.openModal();
  };

  const handleEditClient = (cliente) => {
    props.handleEditClient(cliente);
  };

  const handleCloseModal = () => {
    props.closeModal();
  };

  return (
    <div>
      
      <Modal ariaHideApp={false} isOpen={props.isOpen} style={customStyles}>
        <EditUser
          openModal={handleOpenModal}
          editClient={handleEditClient}
          closeModal={handleCloseModal}
          client={props.cliente}
        />
      </Modal>
    </div>
  );
};

export default CustomModalEdit;
