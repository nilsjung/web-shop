
filename=report

pdf:
	latexmk -pdf -silent ${filename}.tex

open:
	nohup zathura ${filename}.pdf &> /dev/null &

clean:
	latexmk -c

edit:
	nvim ${filename}.tex
