from os import mkdir
import gtts
from playsound import playsound
import sys

word = sys.argv[1]

mkdir('/tmp/words')

storedPath = "/tmp/words/" + word + ".mp3"

tts = gtts.gTTS(word, lang='en')

tts.save(storedPath)
playsound(storedPath)