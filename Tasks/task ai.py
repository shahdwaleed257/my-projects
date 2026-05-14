import chess
import random

# الحركة بحسب التقييم
def minimax(board, depth, maximizing):
    if depth == 0 or board.is_game_over():
        return evaluate_board(board)

    if maximizing:
        max_eval = float('-inf')
        for move in board.legal_moves:
            board.push(move)
            eval = minimax(board, depth - 1, False)
            board.pop()
            max_eval = max(max_eval, eval)
        return max_eval
    else:
        min_eval = float('inf')
        for move in board.legal_moves:
            board.push(move)
            eval = minimax(board, depth - 1, True)
            board.pop()
            min_eval = min(min_eval, eval)
        return min_eval

# تقييم اللوحة
def evaluate_board(board):
    # افتراض تقييم بسيط: عدد القطع البيضاء - عدد القطع السوداء
    score = sum([value_piece(piece) for piece in board.piece_map().values()])
    return score

# تحديد قيمة القطع
def value_piece(piece):
    if piece.symbol().lower() == 'p':
        return 1
    elif piece.symbol().lower() == 'n':
        return 3
    elif piece.symbol().lower() == 'b':
        return 3
    elif piece.symbol().lower() == 'r':
        return 5
    elif piece.symbol().lower() == 'q':
        return 9
    elif piece.symbol().lower() == 'k':
        return 100
    else:
        return 0

def main():
    board = chess.Board()
    depth = 3  # عمق البحث

    while not board.is_game_over():
        if board.turn == chess.WHITE:
            best_move = None
            best_eval = float('-inf')
            for move in board.legal_moves:
                board.push(move)
                eval = minimax(board, depth, False)
                board.pop()
                if eval > best_eval:
                    best_eval = eval
                    best_move = move
            board.push(best_move)
        else:
            opponent_move = input("الخصم: ")
            try:
                board.push_san(opponent_move)
            except:
                print("حركة غير صالحة")

        print(board)

    if board.is_checkmate():
        if board.turn == chess.WHITE:
            print("اللعب الأسود فاز!")
        else:
            print("اللعب الأبيض فاز!")
    else:
        print("تعادل!")

if __name__ == "__main__":
    main()