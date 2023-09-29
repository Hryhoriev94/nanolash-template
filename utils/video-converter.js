const fs = require('fs');
const path = require('path');
const ffmpegPath = require('@ffmpeg-installer/ffmpeg').path;
const ffmpeg = require('fluent-ffmpeg');
ffmpeg.setFfmpegPath(ffmpegPath);

function convertVideo(inputPath, outputPath) {
  return new Promise((resolve, reject) => {
    ffmpeg(inputPath)
      .videoBitrate('3000k')
      .audioBitrate('192k')
      .videoCodec('libvpx')
      .audioCodec('libvorbis')
      .output(outputPath)
      .on('end', resolve)
      .on('error', reject)
      .run();
  });
}

async function processDirectory(directory, convertAll = false) {
  const files = fs.readdirSync(directory);

  for (const file of files) {
    const filePath = path.join(directory, file);
    const stats = fs.statSync(filePath);

    if (stats.isDirectory()) {
      await processDirectory(filePath, convertAll);
    } else if (path.extname(file) === '.mp4') {
      const outputPath = path.join(directory, `${path.basename(file, '.mp4')}.webm`);
      
      if (!convertAll && fs.existsSync(outputPath)) {
        console.log(`Plik ${outputPath} już istnieje`);
        continue;
      }

      console.log(`Konwersja ${filePath} do ${outputPath}`);
      await convertVideo(filePath, outputPath);
      console.log(`Konwersja ${filePath} skonczona`);
    }
  }
}

const startDirectory = path.join(__dirname, '../assets/img');
const convertAll = process.argv.includes('--all');

processDirectory(startDirectory, convertAll)
  .then(() => {
    console.log('Wszystkie konwersje skończone');
  })
  .catch((error) => {
    console.error(`Wystąpił błąd: ${error}`);
  });
