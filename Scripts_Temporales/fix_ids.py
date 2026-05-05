import os
import re

path = 'c:/xampp/htdocs/biblioteca/Assets/js/modulos/'
files = os.listdir(path)

replace_string = """            {
                'data': null,
                'render': function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },"""

for f in files:
    if f.endswith('.js'):
        file_path = os.path.join(path, f)
        with open(file_path, 'r', encoding='utf-8') as file:
            content = file.read()
        
        new_content = re.sub(r"\{\s*'data'\s*:\s*'id'\s*\}\,", replace_string, content)
        
        with open(file_path, 'w', encoding='utf-8') as file:
            file.write(new_content)
