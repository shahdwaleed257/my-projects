# n8n — AI Business Automation Workflows

Importable [n8n](https://n8n.io) workflows that connect AI agents (Google Gemini / OpenAI) to everyday business processes.
The first five are the modules of my capstone project, **AI-Powered Multi-Agent Business Automation System**; the rest are additional systems built with the same approach.

## Workflows

| File | Nodes | What it does | Main integrations |
|---|---|---|---|
| `CRM_workflow.json` | 19 | Scheduled lead processing: pulls lead data (HTTP request / files from Google Drive), analyzes it with Gemini LLM chains, creates leads in Zoho CRM, upserts records in Airtable and sends Gmail notifications | Gemini, Zoho CRM, Airtable, Google Drive, Gmail |
| `HR_CVS_FILLTERING.json` | 13 | Recruitment screening: HR submits a job description form, candidates submit a career application form with a PDF CV; the CV text is extracted, merged with the job description and scored by an AI analyzer; results are stored in Airtable and jobs in Google Sheets | n8n Forms, OpenAI, Google Sheets, Airtable |
| `Final_Workflow_inventory.json` | 17 | Telegram inventory assistant for a clothing store: an AI agent with chat memory answers stock inquiries, checks stock levels, updates Airtable, alerts on low stock by email and confirms or apologizes to the customer | Telegram, Gemini, Airtable, SMTP |
| `Social Media AI Publisher (1).json` | 15 | Daily content pipeline: Gemini writes the post, Stable Diffusion generates the image, imgbb hosts it, then it is published to Facebook, Instagram and Telegram, announced on Discord and logged to Google Sheets and Airtable | Gemini, Stable Diffusion, Facebook/Instagram APIs, Telegram, Discord, Google Sheets, Airtable |
| `Final_Monitor_Social_Media.json` | 20 | Scheduled social-media monitoring: collects data through HTTP tools (also exposed through an MCP Server Trigger), an AI agent summarizes it, negative items trigger a Telegram alert, summary goes out by Gmail and everything is logged to Airtable | Gemini, MCP trigger, Telegram, Gmail, Airtable |
| `inventory_forecast_workflow_ar.json` | 18 | Arabic inventory forecasting and automatic reordering: reads sales history and current stock from Google Sheets, builds a forecast dataset, an OpenAI agent forecasts demand, critical stock is flagged, purchase orders and a daily report are written back to Sheets and sent by Gmail | OpenAI, Google Sheets, Gmail |
| `Hospital - Daily Slot Generator.json` | 49 | WhatsApp appointment-booking assistant for a hospital: AI agent with Redis chat memory and tools (availability, doctors, specialties, appointment lookup); routes intents (book, cancel, reschedule); uses a Redis counter to hold a slot and avoid double booking; notifies affected patients and staff; sends daily reminders and rebooking offers for no-shows | WhatsApp Business, OpenAI, Redis, Google Sheets, Google Calendar |
| `Hospital_Booking_Webhooks_HTTP (2).json` | 54 | Same hospital booking system, re-implemented with webhooks and HTTP requests to a backend API instead of the native Google Sheets nodes | WhatsApp Business, OpenAI, Redis, Webhooks, HTTP |
| `SEO_Multi-Agent_research_agent_google.json` | 47 | SEO content system: a request form starts competitor and keyword research (Brave Search, keyword autocomplete), then specialized Gemini agents handle analysis, keywords, article writing, SEO metadata and internal linking with structured output parsers; results and Search Console / GA4 performance are saved to Google Sheets | Gemini, Brave Search, Google Sheets, Search Console, GA4 |

## How to use

1. In n8n open **Workflows → Import from File** and choose a `.json` file.
2. Create your own credentials for each service the workflow uses (the files reference credentials by name only; no secrets are stored here).
3. Replace the placeholders that were left where secrets used to be:
   - `<FACEBOOK_ACCESS_TOKEN>` — `Final_Monitor_Social_Media.json`, `Social Media AI Publisher (1).json`
   - `<GOOGLE_API_KEY>` — `Final_Monitor_Social_Media.json`
   - `<HUGGINGFACE_TOKEN>` — `Social Media AI Publisher (1).json`
   - `your-email@example.com` — recipient address in `Final_Workflow_inventory.json`
4. Update sheet IDs, Airtable bases, Telegram chat IDs and other resource IDs to your own.
