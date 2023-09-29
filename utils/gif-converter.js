const fs = require('fs');
const path = require('path');
const webp = require('webp-converter');

webp.grant_permission();

function convertGif(inputPath, outputPath) {
    return new Promise((resolve, reject) => {
      const result = webp.gwebp(inputPath, outputPath, "-q 100", "-v");
      result.then((response) => {
        console.log(response);
        if (fs.existsSync(outputPath)) {
          resolve();
        } else {
          reject(new Error('Konwersja nie powiodła się'));
        }
      }).catch(reject);
    });
  }

async function processDirectory(directory, convertAll = false) {
  const files = fs.readdirSync(directory);

  for (const file of files) {
    const filePath = path.join(directory, file);
    const stats = fs.statSync(filePath);

    if (stats.isDirectory()) {
      await processDirectory(filePath, convertAll);
    } else if (path.extname(file) === '.gif') {
      const outputPath = path.join(directory, `${path.basename(file, '.gif')}.webp`);
      
      if (!convertAll && fs.existsSync(outputPath)) {
        console.log(`Plik  ${outputPath} już istnieje, pomijam.`);
        continue;
      }

      console.log(`Konwersja  ${filePath} do ${outputPath}`);
      await convertGif(filePath, outputPath);
      console.log(`Konwersja ${filePath} zakończona`);
    }
  }
}

const startDirectory = path.join(__dirname, '../assets/img');
const convertAll = process.argv.includes('--all');

processDirectory(startDirectory, convertAll)
  .then(() => {
    console.log('Wszystkie konwersje zakończone');
  })
  .catch((error) => {
    console.error(`Wystąpił błąd: ${error}`);
  });
