<?php
/**
 * Plugin Name: AI Lead Assistant
 * Description: A simple AI chat bubble connected to a Flask backend on Vercel.
 * Version: 0.1
 * Author: Samvitha
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Your backend address (the Vercel link + /api/chat)
define( 'AILA_BACKEND', 'https://ai-lead-assistant-backend.vercel.app/api/chat' );

// Add the chat widget to the bottom of every page
add_action( 'wp_footer', function () {
	?>
	<style>
		#aila-btn { position: fixed; right: 20px; bottom: 20px; width: 58px; height: 58px; border-radius: 50%; border: none; background: #0ea5e9; color: #fff; font-size: 26px; cursor: pointer; box-shadow: 0 8px 24px rgba(0,0,0,.25); z-index: 99999; }
		#aila-box { display: none; position: fixed; right: 20px; bottom: 90px; width: 340px; max-width: calc(100vw - 40px); height: 440px; background: #fff; border-radius: 14px; box-shadow: 0 16px 48px rgba(0,0,0,.25); z-index: 99999; flex-direction: column; overflow: hidden; font-family: Arial, sans-serif; }
		#aila-box.open { display: flex; }
		#aila-head { background: #0ea5e9; color: #fff; padding: 14px; font-weight: bold; }
		#aila-msgs { flex: 1; overflow-y: auto; padding: 12px; background: #f8fafc; }
		.aila-msg { margin: 8px 0; padding: 9px 12px; border-radius: 12px; font-size: 14px; line-height: 1.5; max-width: 85%; white-space: pre-wrap; }
		.aila-bot { background: #fff; border: 1px solid #e5e7eb; color: #111; }
		.aila-me { background: #0ea5e9; color: #fff; margin-left: auto; }
		#aila-bar { display: flex; gap: 8px; padding: 10px; border-top: 1px solid #e5e7eb; }
		#aila-input { flex: 1; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; }
		#aila-send { padding: 0 16px; border: none; background: #0ea5e9; color: #fff; border-radius: 8px; cursor: pointer; font-weight: bold; }
	</style>

	<button id="aila-btn" aria-label="Open chat">&#128172;</button>
	<div id="aila-box">
		<div id="aila-head">Chat with us</div>
		<div id="aila-msgs"></div>
		<div id="aila-bar">
			<input id="aila-input" type="text" placeholder="Type your message..." maxlength="1000">
			<button id="aila-send">Send</button>
		</div>
	</div>

	<script>
	(function () {
		var BACKEND = <?php echo wp_json_encode( AILA_BACKEND ); ?>;
		var btn = document.getElementById('aila-btn');
		var box = document.getElementById('aila-box');
		var msgs = document.getElementById('aila-msgs');
		var input = document.getElementById('aila-input');
		var send = document.getElementById('aila-send');

		function addMessage(text, who) {
			var div = document.createElement('div');
			div.className = 'aila-msg ' + (who === 'me' ? 'aila-me' : 'aila-bot');
			div.textContent = text;
			msgs.appendChild(div);
			msgs.scrollTop = msgs.scrollHeight;
			return div;
		}

		addMessage('Hi! How can I help you today?', 'bot');

		btn.onclick = function () { box.classList.toggle('open'); };

		function sendMessage() {
			var text = input.value.trim();
			if (!text) { return; }
			input.value = '';
			addMessage(text, 'me');
			var waiting = addMessage('...', 'bot');
			send.disabled = true;

			fetch(BACKEND, {
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				body: JSON.stringify({ message: text })
			})
			.then(function (r) { return r.json(); })
			.then(function (data) {
				waiting.textContent = data.reply || data.error || 'Something went wrong.';
			})
			.catch(function () {
				waiting.textContent = 'Could not reach the server. Please try again.';
			})
			.then(function () { send.disabled = false; });
		}

		send.onclick = sendMessage;
		input.addEventListener('keydown', function (e) {
			if (e.key === 'Enter') { sendMessage(); }
		});
	})();
	</script>
	<?php
} );
