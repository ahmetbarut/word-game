import imp
from os import mkdir
import os.path as path
import gtts
from playsound import playsound
import sys

try: 
    imp.find_module('gtts')
except ImportError:
    print('Please install gtts')
    sys.exit(1)
try:
    imp.find_module('playsound')
except ImportError:
    print('Please install playsound')
    sys.exit(1)

word = sys.argv[1]

if (path.isdir('/tmp/words')) == False:
    mkdir('/tmp/words')

storedPath = "/tmp/words/" + word + ".mp3"

tts = gtts.gTTS(word, lang='en')

tts.save(storedPath)
playsound(storedPath)