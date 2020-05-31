
filename=report

pdf:
	latexmk -pdf -silent ${filename}.tex

open:
	zathura ${filename}.pdf
clean:
	latexmk -c

edit:
	nvim ${filename}.tex
