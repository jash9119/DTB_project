const profileBtnTemplate = document.createElement("template");

profileBtnTemplate.innerHTML = `
    <style>
        .profile-btn {
            background-color: #e9baff;
            border-style: none;
            font-size: 1.2rem;
            padding-inline: 2rem;
            padding-block: 0.8rem;
            border-radius: 20px;
            float: right;
            margin-block: 1rem;
        }

    </style>

    <body>
        <a href="userprofile.php">
            <button class="profile-btn">
                <i class="fa-regular fa-user"></i>
                Profile
            </button>
        </a>
        
    </body>
`;

class profile extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    const fontAwesome = document.querySelector('link[href*="font-awesome"]');
    const shadowRoot = this.attachShadow({ mode: "closed" });

    if (fontAwesome) {
      shadowRoot.appendChild(fontAwesome.cloneNode());
    }

    shadowRoot.appendChild(profileBtnTemplate.content);
  }
}

customElements.define("profilebtn-component", profile);
