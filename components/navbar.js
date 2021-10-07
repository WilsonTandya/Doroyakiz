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
      align-items: center;
      width: 250px;
      margin-right: 35px;
    }

    .nav-search input {
      width: 100%;
      height: 30px;
      padding: 0 10px;
      color: rgba(49, 53, 59, 0.75);
      border-radius: 4px;
      border: 1px solid rgba(49, 53, 59, 0.35);
    }

    .nav-search input::placeholder {
      color: rgba(49, 53, 59, 0.3);
      opacity: 1;
    }

    .nav-search input:focus {
      outline: none;
    }

    .nav-button-container {
        display: flex;
        align-items: center;
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
  </style>
  <header>
    <nav>
        <a href="index.php">
          <h1>Doroyaki</h1>
        </a>
        <div class="nav-button-container">
          <div class="nav-search">
            <input type="text" placeholder="Cari varian dorayaki..." />
          </div>
          <a href="history.php">
            <div class="text">Riwayat</div>
          </a>
          <a href="login.php">
            <div class="button">Keluar</div>
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
        // const isAuthenticated = this.getAttribute("auth");
        shadowRoot.appendChild(navbarTemplate.content);
    }
}

customElements.define("navbar-component", Navbar);
