# AI Lead Assistant

An AI chat assistant for business websites. It answers visitor questions, understands what they need, and collects their contact details so businesses can follow up with real leads.

**Live Demo:** [https://ai-lead-assistant-backend.vercel.app/](https://ai-lead-assistant-backend.vercel.app/)

> The demo represents a fictional agency, **BrightPath Digital**. Nothing typed in the demo chat is stored.

## Features

- Conversational assistant powered by the **Gemini API**
- Answers visitor questions about the business's services
- Understands visitor intent from the conversation
- Captures lead contact details (name, email, etc.)
- Quick-reply suggestion buttons to start the conversation
- Available as a **WordPress plugin** that saves leads inside WordPress
- Deployed on **Vercel**

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | Python, Flask |
| AI | Google Gemini API |
| Frontend | HTML, CSS, JavaScript |
| Integration | WordPress plugin |
| Deployment | Vercel |

## How It Works

1. The visitor sends a message through the chat widget.
2. The frontend sends the message to the Flask backend.
3. The backend builds a prompt with the business context and conversation history, then calls the Gemini API.
4. The assistant replies, and when the visitor shows interest it asks for contact details.
5. In the WordPress plugin version, the captured lead is saved inside WordPress.

## Getting Started

### Prerequisites

- Python 3.9+
- A Gemini API key from [Google AI Studio](https://aistudio.google.com/)

### Installation

```bash
git clone https://github.com/samvithak7-coder/[REPO_NAME].git
cd [REPO_NAME]
pip install -r requirements.txt
```

### Configuration

Create a `.env` file in the project root:

```
GEMINI_API_KEY=your_api_key_here
```

### Run locally

```bash
python app.py
```

Then open `http://localhost:5000` in your browser.

## Deployment

The app is deployed on Vercel. Set `GEMINI_API_KEY` as an environment variable in your Vercel project settings, then deploy from GitHub for automatic redeploys.

## WordPress Plugin

1. Download the plugin folder / zip from `[PLUGIN_FOLDER_PATH]`.
2. In WordPress, go to **Plugins → Add New → Upload Plugin** and activate it.
3. Add your Gemini API key in the plugin settings.
4. Captured leads appear in `[WHERE_LEADS_ARE_SHOWN, e.g. the WordPress admin dashboard]`.

## Customizing for Your Business

Edit the business context and prompt in `[FILE_NAME]` to change the company name, services and tone of the assistant.

## Author

**Kesapragada Venkata Prabha Sai Samvitha**
[Portfolio](https://samvitha-portfolio.vercel.app/) | [LinkedIn](https://www.linkedin.com/in/kesapragada-samvitha-977714376/) | [GitHub](https://github.com/samvithak7-coder)
