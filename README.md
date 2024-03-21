# ninjacord-webhook-translator

This API integrates Discord webhooks with NinjaOne RMM, enabling seamless notifications and updates through Discord.
I'm a young developer so supporting me would be greatly appreciated!

<a href="https://www.buymeacoffee.com/redbaron2k7" target="_blank"><img src="https://cdn.buymeacoffee.com/buttons/v2/default-yellow.png" alt="Buy Me A Coffee" style="height: 60px !important;width: 217px !important;" ></a>

## Overview

`ninjacord-webhook-translator` bridges NinjaOne RMM with Discord, allowing users to receive NinjaOne notifications directly in Discord. This is especially useful for IT administrators and teams who rely on NinjaOne for remote monitoring and management and use Discord for team communications.

## Getting Started

### Prerequisites

Before you begin, ensure you have:

- A web server to host the API.
- Discord account and the permissions to create webhooks.

### Installation

1. **Deploy the API**: Download `api.php` and upload it to your web server.

2. **Configure NinjaOne**:
   - Log in to your NinjaOne panel.
   - Navigate to the Administration page.
   - Go to 'Apps' and select 'Notification Channels'.
   - Click "Add" and choose 'Webhook'. Provide a meaningful name and description for easy identification.

3. **Set Webhook URL**:
   - In the URL field, enter `https://[your-web-server-url]/api.php`.
   - Replace `[your-web-server-url]` with the actual URL of your webserver where `api.php` is hosted.

4. **Test the Integration**:
   - Send a test notification from NinjaOne to verify that it's correctly received in Discord.

### Usage

After setting up, your NinjaOne notifications will be automatically forwarded to the specified Discord channel via the webhook. You can manage and customize your notification preferences within the NinjaOne panel.

Note: You have to select notification channels for each condition in the NinjaOne panel

## Support

For support, issues, or feature requests, please [open an issue](https://github.com/redbaron2k7/ninjacord-webhook-translator/issues) on our GitHub repository.

## Suggestions and Contributions

Your feedback and suggestions are invaluable to me! If you have ideas on how to improve `ninjacord-webhook-translator`, or if you'd like to contribute to the project, we'd love to hear from you.

### How to Contribute:

1. **Share Your Ideas**: Have a feature in mind or a suggestion to enhance the tool? Please [submit your ideas](https://github.com/redbaron2k7/ninjacord-webhook-translator/issues) via our GitHub issues.

2. **Contribute to the Code**: If you're interested in directly contributing to the codebase, feel free to fork the repository and submit a pull request with your changes. See our contributing guidelines for more details.

3. **Report Bugs**: Encountered a bug? Let me know by [opening an issue](https://github.com/redbaron2k7/ninjacord-webhook-translator/issues). Please provide as much detail as possible to help us fix it quickly.

Your contributions help make `ninjacord-webhook-translator` more effective for everyone!
