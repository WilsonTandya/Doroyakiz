const navbarTemplate = document.createElement('template');
navbarTemplate.innerHTML = `
  <style>
    h1 {
      font-size: 2rem;
    }

    nav {
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);
      padding: 0 210px;
    }

    a {
        border: none;
        text-decoration: none;
        background-color: #41B54A;
        color: #FCFEFF;
        padding: 6px 15px;
        font-size: .9em;
        font-weight: bold;
        border-radius: 5px;
        transition: 0.1s;
    }

    a:hover {
        opacity: 0.8;
    }

    button:hover, button:focus {
        cursor: pointer;
        outline: none;
    }
    
    ul li {
      list-style: none;
      display: inline;
    }

  </style>
  <header>
    <nav>
        <h1>Doroyaki</h1>
        <a href="login.php">LOG OUT</a>
    </nav>
  </header>
`;

class Navbar extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    const shadowRoot = this.attachShadow({ mode: 'closed' });
    // const isAuthenticated = this.getAttribute("auth");
    shadowRoot.appendChild(navbarTemplate.content);
  }
}

customElements.define('navbar-component', Navbar);