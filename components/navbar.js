const navbarTemplate = document.createElement("template");
navbarTemplate.innerHTML = `
  <style>
    h1 {
        font-size: 2rem;
        color: #41B54A;
        cursor: pointer;
    }

    nav {
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);
        padding: 0 210px;
    }

    .nav-search {
        display: flex;
        flex-direction: row;
        align-items: center;
        width: 250px;
    }

    .nav-search input {
        width: 100%;
        height: 30px;
        padding: 0 10px;
        color: rgba(49, 53, 59, 0.75);
        border-radius: 4px 0 0 4px;
        border: 1px solid rgba(49, 53, 59, 0.35);
    }

    .nav-search input::placeholder {
        color: rgba(49, 53, 59, 0.3);
        opacity: 1;
    }

    .nav-search input:focus {
        outline: none;
    }

    .btn-submit {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 10%;
        text-align: center;
        height: 33px !important;
        margin-right: 35px;
        border: none;
        border-radius: 0 4px 4px 0;
        cursor: pointer;
        outline: none;
    }

    .btn-submit img {
        width: 20px;
    }

    .nav-button-container {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    a {
        font-size: .9em;
        font-weight: bold;
        text-decoration: none;
    }

    a .text {
        margin-right: 20px;
        transition: 0.1s;
        font-weight: bold;
        color: black;
    }

    a .text:hover {
        opacity: 0.7;
    }

    a .button {
        border: none;
        background-color: #d8414a;
        color: #FCFEFF;
        padding: 6px 15px;
        border-radius: 5px;
        transition: 0.2s;
    }

    a .button:hover {
        opacity: 0.8;
    }

    button:hover, button:focus {
        cursor: pointer;
        outline: none;
    }

    .history-img {
        display: none;
        width: 25px;
        margin-right: 10px;
    }

    .exit-img {
        display: none;
        width: 20px;
    }

    @media screen and (max-width: 1280px) {
        nav {
            padding: 0 120px;
        }

        .nav-search {
            width: 200px;
        }

        .btn-submit {
            margin-right: 20px;
        }
    }

    @media screen and (max-width: 1000px) {
        .nav-search {
            width: 150px;
        }
    }

    @media screen and (max-width: 800px) {
        nav {
            padding: 0 20px;
        }

        .text {
            display: none
        }

        .button {
            display: none
        }

        .history-img {
            display: flex;
        }

        .exit-img {
            display: flex;
        }

        .btn-submit {
            margin-right: 10px;
        }
    }
  </style>
  <header>
    <nav>
        <a href="index.php">
          <h1>Dorayakiz</h1>
        </a>
        <div class="nav-button-container">
          <form class="nav-search" id="form-search" name="form-search" action="list.php" method="GET" autocomplete="off" >
            <input type="text" name="query" placeholder="Cari varian dorayaki..." />
          </form>
          <button class="btn-submit" type="submit" form="form-search" value="Submit">
            <img src="../assets/icon-search.png" alt="Cari" />
          </button>
          <a href="purchase_history.php">
            <div class="text">Riwayat</div>
            <img class="history-img" src="../assets/icon-history.png" alt="Riwayat" />
          </a>
          <a href="sign_out.php">
            <div class="button">Keluar</div>
            <img class="exit-img" src="../assets/icon-exit.png" alt="Keluar" />
          </a>
        </div>
    </nav>
  </header>
`;

class Navbar extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        const shadowRoot = this.attachShadow({ mode: "closed" });
        shadowRoot.appendChild(navbarTemplate.content);
    }
}

customElements.define("navbar-component", Navbar);
