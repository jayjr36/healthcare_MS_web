import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: ChatScreen(),
    );
  }
}

class ChatScreen extends StatefulWidget {
  @override
  _ChatScreenState createState() => _ChatScreenState();
}

class _ChatScreenState extends State<ChatScreen> {
  final TextEditingController _controller = TextEditingController();
  List<Map<String, dynamic>> _messages = [];
  String _chatId;

  @override
  void initState() {
    super.initState();
    _createChat();
  }

  void _createChat() async {
    final response = await http.post(
      Uri.parse('https://yourapiurl.com/api/create-chat'),
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + await _getToken()  // Replace with your token retrieval method
      },
      body: json.encode({'doctor_id': 1}),  // Replace with actual doctor ID
    );

    if (response.statusCode == 200) {
      final data = json.decode(response.body);
      setState(() {
        _chatId = data['id'];
      });
      _loadMessages();
    }
  }

  Future<String> _getToken() async {
    // Implement your token retrieval logic here
    return 'your_token_here';
  }

  void _loadMessages() async {
    final response = await http.get(
      Uri.parse('https://yourapiurl.com/api/get-messages/$_chatId'),
      headers: {
        'Authorization': 'Bearer ' + await _getToken()
      }
    );

    if (response.statusCode == 200) {
      final data = json.decode(response.body);
      setState(() {
        _messages = data;
      });
    }
  }

  void _sendMessage() async {
    if (_controller.text.isEmpty) return;

    final response = await http.post(
      Uri.parse('https://yourapiurl.com/api/send-message/$_chatId'),
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + await _getToken()
      },
      body: json.encode({'message': _controller.text}),
    );

    if (response.statusCode == 200) {
      final data = json.decode(response.body);
      setState(() {
        _messages.add(data);
        _controller.clear();
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text('Chat with Doctor')),
      body: Column(
        children: [
          Expanded(
            child: ListView.builder(
              itemCount: _messages.length,
              itemBuilder: (context, index) {
                final message = _messages[index];
                return ListTile(
                  title: Text('${message['user']['name']}: ${message['message']}'),
                );
              },
            ),
          ),
          Padding(
            padding: const EdgeInsets.all(8.0),
            child: Row(
              children: [
                Expanded(
                  child: TextField(
                    controller: _controller,
                    decoration: InputDecoration(
                      hintText: 'Type a message',
                    ),
                  ),
                ),
                IconButton(
                  icon: Icon(Icons.send),
                  onPressed: _sendMessage,
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}
